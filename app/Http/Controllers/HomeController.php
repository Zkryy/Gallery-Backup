<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all(); // Retrieve all posts
        return view('home', compact('posts'));
    }
}
