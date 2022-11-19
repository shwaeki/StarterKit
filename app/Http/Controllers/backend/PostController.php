<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-post');
        $this->middleware('permission:create-post', ['only' => ['create','store']]);
        $this->middleware('permission:update-post', ['only' => ['edit','update']]);
        $this->middleware('permission:destroy-post', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('backend.post.index');
    }


    public function create()
    {
        $categories = Category::pluck('category_name', 'id');
        return view('backend.post.create', compact('categories'));
    }


    public function store(PostRequest $request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
        $post = $request->except('featured_image');
        if ($request->featured_image) {
            $post['featured_image'] = parse_url($request->featured_image, PHP_URL_PATH);
        }
        Post::create($post);
        flash('Post created successfully!')->success();
        return redirect()->route('post.index');
    }


    public function show(Post $post)
    {
        $post->with(['category','user']);
        return view('backend.post.show', compact( 'post'));
    }


    public function edit(Post $post)
    {
        $post->with(['category','user']);
        $categories = Category::pluck('category_name', 'id');
        return view('backend.post.edit', compact( 'categories', 'post'));
    }


    public function update(PostRequest $request, Post $post)
    {
        $postdata = $request->except('featured_image');
        if ($request->featured_image) {
            $postdata['featured_image'] = parse_url($request->featured_image, PHP_URL_PATH);
        }
        $post->update($postdata);
        flash('Post updated successfully!')->success();
        return redirect()->route('post.index');
    }


    public function destroy(Post $post)
    {
        $post->delete();
        flash('Post deleted successfully!')->info();
        return redirect()->route('post.index');
    }
}
