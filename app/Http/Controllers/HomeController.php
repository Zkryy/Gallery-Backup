<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $posts = Post::all(); // Retrieve all posts

        // Check if the user has submitted a search query
        if ($request->filled('search')) {
            // Filter posts based on search query
            $search = $request->input('search');
            $posts->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        }

        return view('home', compact('posts'));
    }   
}
