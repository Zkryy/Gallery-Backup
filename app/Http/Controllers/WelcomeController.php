<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        // Retrieve some sample posts
        $samplePosts = Post::inRandomOrder()->take(8)->get();

        // Pass the sample posts to the welcome view
        return view('welcome', compact('samplePosts'));
    }
}
