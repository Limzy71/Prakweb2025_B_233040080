<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with(['author', 'category'])->get();
        return view('posts', compact('posts'));
    }

    public function show(Post $post) {
        $post->load(['author', 'category']);
        return view('post', compact('post'));
    }
}