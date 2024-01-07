<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Str;
// use Brian2694\Toastr\Facades\Toastr;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        // $posts = Post::latest()->paginate(10);
        return view('backend.post.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'required|max:50',
            'sub_title' => 'required|max:50',
            'description' => 'required',
            // 'topic' => 'required|array'
        ]);

        // $post = Post::create(['title' => $request->title, 'sub_title' => $request->sub_title, 'description' => $request->description, 'slug' => Str::slug($request->title), 'lang' => app()->getLocale(), 'profile_id' => Auth::user()->profile->id]);
        $post = Post::create(['title' => $request->title, 'sub_title' => $request->sub_title, 'description' => $request->description, 'slug' => Str::slug($request->title)]);
        Session::flash('success','Create Successfully');
        return redirect()->route('post.index');
        // $post->topics()->attach($request->topic);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit')
        ->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:50',
            'sub_title' => 'required|max:50',
            'description' => 'required',
            // 'topic' => 'required|array'
        ]);
        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->description = $request->description;
        $post->slug = Str::slug($request->title);
        $post->save();
        Session::flash('success','Update Successfully');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('error','Deleted Successfully');
        // return 'great';
        // return Toastr::success('Post Successfully Deleted','Success');
    }
    public function trash(){
        $posts=Post::onlyTrashed()->paginate(10);
        return view('backend.post.trash',compact('posts'));
        // $posts=Post::onlyTrashed()->get();
        // return view('backend.post.trash')->with('posts',$posts);
    }

    public function delete($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        return "success";
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->restore();

        return redirect()->route('post.index');
    }
}
 