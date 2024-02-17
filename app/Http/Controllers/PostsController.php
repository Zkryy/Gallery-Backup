<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5048'],
        ]);
    
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = auth()->id();
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $post->image = $fileName;
        }
    
        $post->save();
    
        return back()->withMessage('Your image has been uploaded!');
    }
    

    public function show(Post $post)
    {
        return view('posts.detail', compact('post'));
    }

    public function like(Post $post)
    {
        $post->likes()->toggle(auth()->id());
        return back();
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:255'],
        ]);

        $post->comments()->create([
            'content' => $request->comment,
            'user_id' => auth()->id(),
        ]);

        return back();
    }
}