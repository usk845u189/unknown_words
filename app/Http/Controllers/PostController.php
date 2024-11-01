<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::where('user_id',\Auth::user()->id)->get();
        return view('post.index',['posts' => $posts]);
    }

    public function detail(Request $request, $id)
    {
        $post = Post::find($id)->toArray();
        return view('post.detail',['post' => $post]);
    }

    public function create(Request $request)
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'body' => 'required|string',
        ]);



        $post = new Post();
        $post->user_id = \Auth::id();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->body = $request->body;
        $post->save();

        return redirect("post/");
    }

    public function api(Request $request)
    {
        $posts = Post::where('user_id',\Auth::user()->id)->get();
        return response($posts);
    }
}
