<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Subscription;
use App\Models\Post;
use App\Models\Submission;
use App\Models\SubmissionFile;
use Illuminate\Support\Facades\Validator;

use Illuminate\View\View;

class PagesController extends Controller
{
    public static function index($model, $locales){


		

		if ($model->type['type'] == 5) {
			$child_section = Section::where('parent_id', $model->id)->with('translations')->orderBy('order', 'asc')->first();
			$model = ($child_section ?? $model);
		}
		if ($model->type['type'] == 0) {
            
            return self::homePage($locales);
        }
        if (request()->method() == 'POST') {
            $post = Post::where('section_id', $model->id)->with('translations', 'files')->first();
            return self::submission($post);
        }
		
		if ($model->type['type'] == 1) {
            $post = Post::where('section_id', $model->id)->with('translations', 'files')->first();
            return self::show($post, $locales);
        }
		
		

		$section = $model;

		// BreadCrumb ----------------------------
		$breadcrumbs = [];
		$sec = $model;
		$breadcrumbs[] = [
			'name' => $sec->title,
			'url' => $sec->getFullSlug()
		];
		while($sec->parent_id !== null){
			$sec = Section::where('id', $sec->parent_id)->with('translations')->first();
			$breadcrumbs[] = [
				'name' => $sec->title,
				'url' => $sec->getFullSlug()
			];
		}
		$sec = Section::where('type_id', sectionTypes()['home']['id'])->with('translations')->first();
		
		$breadcrumbs[] = [
			'name' => $sec->title,
			'url' => $sec->getFullSlug()
		];
		$breadcrumbs = array_reverse($breadcrumbs);

		
		$posts = Post::where('section_id', $model->id)
		->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
		->where('post_translations.locale', '=', app()->getLocale())
		->select('posts.*', 'post_translations.text', 'post_translations.desc', 'post_translations.title', 'post_translations.locale_additional', 'post_translations.slug');
		
		if (isset($model->type['order_by'])) {
			$posts = $posts->orderBy($model->type['order_by'], 'asc');
		}
		
		$posts = $posts->orderBy('date', 'desc')->orderBy('created_at', 'desc')->with(['translations', 'slugs'])->paginate($model->type['paginate']?? 9);
        return view("website.pages.{$model->type['folder']}.index", compact(['section', 'posts', 'breadcrumbs', 'locales']));
    }

    public static function show($model, $locales){

        if (request()->method() == 'POST') {
            return self::submission($model);
        }

		// BreadCrumb ----------------------------
		$breadcrumbs = [];
		$sec = Section::where('id', $model->section_id)->with('translations')->first();
		$breadcrumbs[] = [
			'name' => $sec->title,
			'url' => $sec->getFullSlug()
		];
		while($sec->parent_id !== null){
			$sec = Section::where('id', $sec->parent_id)->with('translations')->first();
			$breadcrumbs[] = [
				'name' => $sec->title,
				'url' => $sec->getFullSlug()
			];
		}
		$sec = Section::where('type_id', sectionTypes()['home']['id'])->with('translations')->first();
		
		$breadcrumbs[] = [
			'name' => $sec->title,
			'url' => $sec->getFullSlug()
		];
		$breadcrumbs = array_reverse($breadcrumbs);



        $section = $model->parent()->first();
        return view("website.pages.{$section->type['folder']}.show", [
            'section' => $section,
            'post' => $model,
			'breadcrumbs' => $breadcrumbs,
			'locales' => $locales
        ])->render();
        
    }


    public static function submission($model){
        $values = request()->all();
        Validator::validate($values, [
            'email' => 'email'
        ]);
        $values['additional'] = getAdditional($values, config('submissionAttr.additional'));
        $values['post_id'] = $model->id;
        $submission = Submission::create($values);


        if (isset($values['file']) && count($values['file']) > 0) {
            foreach ($values['file'] as $key => $file){
                $file_name = uniqid() . "." . $file->getClientOriginalExtension();
                $file->move('/uploads/submissions/', $file_name);
                $submissionFile = [   
                    'submission_id' => $submission->id,
                    'file' => '/uploads/submissions/'.$file_name,
                    'name' => $file->getClientOriginalName(),
                    'extention' => $file->getClientOriginalExtension()
                ];
                SubmissionFile::create($submissionFile);
            }
        }


        return redirect()->back()->with([
            'message' => trans('website.submission_sent'),
        ]);



    }


	public static function homePage($locales = null){
		
		if ($locales == null) {
			$locales = [];
			foreach (config('app.locales') as $value) {
				$locales[$value] =  '/'.$value;
				
			}
		}
		
		$mainBanner = Banner::where('type_id', bannerTypes()['main_banner']['id'])->with('translations', 'files')->get();
		
		$sideBanners = Banner::where('type_id', bannerTypes()['side_banner']['id'])->with('translations', 'files')->limit(3)->get();

		$news = Post::where('section_id', settings('News_page'))->orderBy('date', 'desc')->orderBy('created_at', 'desc')->with('translations')->limit(2)->get();
		$newsSection = Section::where('id', settings('News_page'))->with('translations')->first();
		
		$videos = Post::where('section_id', settings('videos_page'))->orderBy('date', 'desc')->orderBy('created_at', 'desc')->with('translations')->limit(2)->get();
		$videosSection = Section::where('id', settings('videos_page'))->with('translations')->first();
		
        return view('website.home', compact('locales', 'mainBanner', 'news', 'newsSection', 'videos', 'videosSection', 'sideBanners'));
	}

	public static function subscribe(Request $request){
		$validatedData = $request->validate([
			'email' => 'required|email',
		]);
		$subscriber = Subscription::where('email',$validatedData['email'])->first();
		if($subscriber == null){
			
			$subscription = new Subscription;
			$subscription->locale = app()->getLocale();
			$subscription->email = $validatedData['email'];
			$subscription->save();

			return response()->json(trans('website.successfuly_subscribed'));
			
		}
		return response()->json(trans('website.allready_subscribed'));
		
	}


	public static function search(Request $request){
		$validatedData = $request->validate([
			'text' => 'required',
		]);
		$searchText = $validatedData['text'];
		$posts = Post::whereHas('translations', function($q) use($searchText) {
            $q->whereActive(true)->whereLocale(app()->getLocale())
			->where('title', 'LIKE', "%{$searchText}%") 
			->orWhere('desc', 'LIKE', "%{$searchText}%") 
			->orWhere('text', 'LIKE', "%{$searchText}%") 
			->orWhere('keywords', 'LIKE', "%{$searchText}%") 
			->orWhere('locale_additional', 'LIKE', "%{$searchText}%");
        })->with('translations')->paginate(5);
		$data = [];
		foreach($posts as $post){
			$data[] = [
				'slug' => $post->getFullSlug() ?? '#',
				'title' => $post->translate(app()->getLocale())->title,
				'desc' => str_limit(strip_tags($post->translate(app()->getLocale())->desc), 320),
			];
		}
		return response()->json(['data' => $data]);
		
	}

}
