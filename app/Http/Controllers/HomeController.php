<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = $request->input('query');

        // Query the posts based on the search query
        $posts = Post::query();

        if ($query) {
            $posts->where('title', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%");
        }

        $posts = $posts->get();

        return view('home', compact('posts', 'query'));
    }   
}
