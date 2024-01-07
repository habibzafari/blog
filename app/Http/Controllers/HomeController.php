<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(10);
        return view('frontend.home.index', compact('posts'));
        // return view('frontend.home.index', ['posts' => $posts]);

    }
}
