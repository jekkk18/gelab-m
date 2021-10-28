<?php

namespace App\Http\View\Composers;


use Illuminate\View\View;
use App\Models\Section;
use App\Models\Banner;
class WebsiteComposer
{
    private $sections;
    public function __construct()
    {
        $this->sections = Section::whereHas('translations', function($q) {
            $q->whereActive(true)->whereLocale(app()->getLocale());
        })
        ->whereHas('menuTypes', function($q){
            $q->where('menu_type_id', 0);
        })
		->whereHas('translations', function($q){
			$q->where('active', 1);
		})->with(array('children' => function($query) {
            $query->whereHas('menuTypes', function($q){
                $q->where('menu_type_id', 0);
            })->orderBy('order', 'asc')->orderBy('created_at', 'desc');
		}))
        ->with(['translations', 'menuTypes'])
				->where('parent_id', null)
        ->orderBy('order', 'asc')->orderBy('created_at', 'desc')
        ->get();
       
		$this->textPages = Banner::where('type_id', bannerTypes()['bottom_banner']['id'])->with('translations', 'files')->limit(3)->get();
    }

    
    public function compose(View $view)
    {
        $view->with([
			'sections' => $this->sections,
			'textPages' => $this->textPages
		]);
    }
}