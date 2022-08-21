<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('blog', compact('posts'));
    }
}
