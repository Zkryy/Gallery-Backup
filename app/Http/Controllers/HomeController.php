<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = $request->input('query');
        $tag = $request->input('tag');

        // Query the posts based on the search query
        $posts = Post::query();

        if ($query) {
            $posts->where('title', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%");
        }

        if ($tag) {
            // Ensure the tag starts with "#"
            if (strpos($tag, '#') !== 0) {
                $tag = '#' . $tag;
            }

            // Search for tag with or without "#" symbol
            $posts->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag);
            });
        }

        $posts = $posts->get();

        // Retrieve all tags for tag buttons
        $tags = Tag::pluck('name');

        return view('home', compact('posts', 'query', 'tags', 'tag'));
    }


}
