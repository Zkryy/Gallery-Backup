<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    
        // Update title and description
        $post->title = $request->title;
        $post->description = $request->description;
    
        // Save the updated post
        $post->save();
    
        return redirect()->route('detail', ['post' => $post->id])->withMessage('Post updated successfully.');
    }
    
    
    public function destroy(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== auth()->id()) {
            return back()->with('error', 'You are not authorized to delete this post.');
        }

        // Delete the image file from storage
        File::delete(public_path('images/' . $post->image));

        // Delete the post from the database
        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
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
            'content' => ['required', 'string', 'max:255'],
        ]);
    
        $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);
    
        return back();
    }

    public function delete(Comment $comment)
    {
        // Check if the authenticated user is authorized to delete the comment
        if ($comment->user_id === auth()->id()) {
            // Delete the comment
            $comment->delete();
        }
        
        return back(); // Redirect back to the page where the comment was deleted from
    }

    
}