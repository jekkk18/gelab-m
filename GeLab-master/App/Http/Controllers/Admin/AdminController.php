<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostTranslation;
use App\Models\Submission;

class AdminController extends Controller
{
    public function index(){
        $submissions = Submission::orderBy('created_at')->limit(10)->get();

        $postDrafts = PostTranslation::whereNotNull('title')->where('active', 0)->with('post.parent', 'post.author')->limit(10)->get();
        return view('admin.home', compact('submissions','postDrafts'));
    }


    
}
