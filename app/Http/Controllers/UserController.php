<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        foreach ($posts as $post){
            $post->update(['likes' => rand(0, 1000)]);
        }
        $users = Cache::remember('users', now()->addMinutes(10), function () {
            return User::all();
        });

        return view('user.index', compact('users'));
    }
}
