<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('posts', now()->addMinutes(10), function () {
            return Post::all();
        })->each(function ($post) {
            Cache::put('posts:'.$post->id, $post);
        });

        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Cache::get('posts:'.$id);

        dd($post->title);
    }

    public function store()
    {
        
    }
}
