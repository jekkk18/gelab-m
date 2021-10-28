<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\MenuSection;
use App\Models\Post;
use App\Models\PostFile;
use Illuminate\Support\Facades\Validator;
use App\Models\PostTranslation;
use App\Models\Slug;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index($sec){
        $section = Section::where('id', $sec)->with('translations')->first();
		
        if (isset($section->type) && $section->type['type'] === 1) {
            $post = Post::where('section_id', $sec)->with(['translations', 'slugs'])->first();
            if (isset($post) && $post !== null) {
                return Redirect::route('post.edit', [app()->getLocale(), $post->id,]);
            }
            return Redirect::route('post.create', [app()->getLocale(), $sec,]);

        }
        
        $posts = Post::where('section_id', $sec)->orderBy('date', 'desc')->orderBy('created_at', 'desc')
		->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
		->where('post_translations.locale', '=', app()->getLocale())
		->select('posts.*', 'post_translations.text', 'post_translations.desc', 'post_translations.title', 'post_translations.locale_additional', 'post_translations.slug');
		
		if (isset($section->type['order_by'])) {
			$posts = $posts->orderBy($section->type['order_by'], 'asc');
		}
		
		$posts = $posts->with(['translations', 'slugs'])->paginate(9);
        return view('admin.posts.list', compact(['section', 'posts']));
    }

    public function create($sec){
        $section = Section::where('id', $sec)->with('translations')->first();
        
        return view('admin.posts.add', compact(['section']));
    }


    
    public function store($sec, Request $request){
        $section = Section::where('id', $sec)->with('translations')->first();
        $values = $request->all();
		
        $post = null;
        
        $this->storePost($values, $section, $post);

        
        return Redirect::route('post.list', [app()->getLocale(), $section->id,]);
    }




    public function edit($post){
        $post = Post::where('id', $post)->with(['translations', 'files'])->first();
		
        $section = Section::where('id', $post->section_id)->with('translations')->first();
        
        return view('admin.posts.edit', compact('section', 'post'));
    }



    public function update($post, Request $request){
        $post = Post::where('id', $post)->with('translations')->first();
        $section = Section::where('id', $post->section_id)->with('translations')->first();
        $values = $request->all();

        $this->storePost($values, $section, $post);

        
        return Redirect::route('post.list', [app()->getLocale(), $section->id,]);
    }

    public function destroy($post){

        $post = Post::where('id', $post)->first();
        
        $section = Section::where('id', $post->section_id)->with('translations')->first();

        $files = PostFile::where('post_id', $post->id)->get();
        foreach($files as $file){
            if(File::exists(config('config.image_path').$file->file)) {
                File::delete(config('config.image_path').$file->file);
            }
            if(File::exists(config('config.image_path').'thumb/'.$file->file)) {
                File::delete(config('config.image_path').'thumb/'.$file->file);
            }

            $file->delete();
        }

        PostTranslation::where('post_id', $post->id)->delete();

        $post->delete();

        
        return Redirect::route('post.list', [app()->getLocale(), $section->id,]);
    }








    protected function storePost($values, $section, $post){

		if (!array_key_exists('section_id', $values) || $values['section_id'] == null) {
			$values['section_id'] = $section->id;
		}
        $values['author_id'] = auth()->user()->id;
        $postFillable = (new Post)->getFillable();
        $postTransFillable = (new PostTranslation)->getFillable();
		

        $values['additional'] = getAdditional($values, array_diff(array_keys($section->fields['nonTrans']), $postFillable) );
        foreach(locales() as $locale){
            if (isset($values[$locale]['slug'])) {
                $values[$locale]['slug'] = str_replace(' ', '-', $values[$locale]['slug']);
            }
			
			if (isset($values[$locale]['slug'])) {
				if (isset($post) && $post !== null){
					$slugexists = PostTranslation::where('slug', $values[$locale]['slug'])->where('post_id', '!=', $post->id)->first();
				}else{
					$slugexists = PostTranslation::where('slug', $values[$locale]['slug'])->first();
				}
			}
			if (isset($values[$locale]['slug'])) {
				$tempSlug = $values[$locale]['slug'];
				$i = 1;
				while ($slugexists !== null) {
					$values[$locale]['slug'] = $tempSlug.$i;

					if (isset($post) && $post !== null){
						$slugexists = PostTranslation::where('slug', $values[$locale]['slug'])->where('post_id', '!=', $post->id)->first();
					}else{
						$slugexists = PostTranslation::where('slug', $values[$locale]['slug'])->first();
					}
				}
			}
            

            if (isset($values[$locale]['file'])) {
				foreach ($values[$locale]['file'] as $key => $value) {
					if (!is_array($value)) {
					
						$originalName = $value->getClientOriginalName();
						$newName = uniqid() . "." . $value->getClientOriginalExtension();
						$value->move(config('config.file_path'), $newName );
						$values[$locale][$key] = [
							"name" => $originalName,
							"file" => $newName
						];
					}
				}
				
			} else{
				if (isset($values[$locale]['publications'])) {
					$values[$locale]['publications'] = [
						"name" => $values[$locale]['publications']["'name_old'"],
						"file" => $values[$locale]['publications']["'file_old'"]
					];
				}
			}
			
			if (isset($values[$locale]['files']) && $values[$locale]['files'] !== null) {
				foreach ($values[$locale]['files'] as $key => $files) {
					if (array_key_exists('same',$values[$locale]['files'][$key])) {
						foreach (config('app.locales') as $lang) {
							if ($lang != $locale) {
								if (!array_key_exists($key, $values[$lang])) {
									$values[$lang][$key] = [];
								}
								foreach ($values[$locale]['files'][$key]['file'] as $k => $value) {
									$values[$lang][$key][] = [
										'file' => $value,
										'name' => $files['desc'][$k]
									];
								}
							}
						}
					}
						$values[$locale][$key] = [];
						foreach ($values[$locale]['files'][$key]['file'] as $k => $value) {
							$values[$locale][$key][] = [
								'file' => $value,
								'name' => $files['desc'][$k]
							];
						}
					
					
				}
			}
            
        }
		foreach (config('app.locales') as $locale) {
			$values[$locale]['locale_additional'] = getAdditional($values[$locale], array_diff(array_keys($section->fields['trans']), $postTransFillable) ); 
		}
		
        if (isset($post) && $post !== null) {

            
            
            $allOldFiles = PostFile::where('post_id', $post->id)->get();
      
            foreach ($allOldFiles as $key => $fil) {
                if(isset($values['old_file']) && count($values['old_file']) > 0) {
                if(!in_array($fil->id, array_keys ($values['old_file']))){
                    $fil->delete();
                }
                }else{
                $fil->delete();
                }
                
            }
            Post::find($post->id)->update($values);

        }else{
            $post = Post::create($values);
			foreach(locales() as $locale){
				$post->slugs()->create([
					'fullSlug' => genFullSlug($post, $locale),
					'locale' => $locale
				]);
			}
        }
        

        if (isset($values['files']) && count($values['files']) > 0) {
			
            foreach($values['files'] as $key => $files){
				foreach($files['file'] as $k => $file){
					$postFile = new PostFile;
					$postFile->type = $key;
					$postFile->file = $file;
					$postFile->title = $values['files'][$key]['desc'][$k];
					$postFile->post_id = $post->id;
					$postFile->save();
				}
            }
        }
        

        
    }


	

	

    


}
