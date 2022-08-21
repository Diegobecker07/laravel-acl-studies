<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->paginate(12);
        return view('blog', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('more', ['post' => $post]);
    }
}
