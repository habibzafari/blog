<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(10);
        $setting = Setting::first();
        return view('frontend.home.index', compact('posts'));
        // return view('frontend.home.index', ['posts' => $posts]);

    }
    public function show($slug){
        $post= Post::where('slug',$slug)->first();
        return view('frontend.home.show',compact('post'));
    }
}
