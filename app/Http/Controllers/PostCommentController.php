<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment; // Assuming you have a Comment model

class PostCommentController extends Controller
{
    public function comment(Request $request, Post $post)
    {
        // Validate the comment data
        $request->validate([
            'content' => 'required|string|max:1000', // Adjust max length if needed
        ]);

        // Create a new comment for the post
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id; // Assuming post_id is the foreign key
        // You may need to adjust the following line based on your table structure
        $comment->image_id = $post->image_id; // Assuming image_id is the foreign key
        $comment->content = $request->content;
        $comment->save();

        // Optionally, you can send notifications or perform other actions here

        // Return a success response
        return back()->with('success', 'Comment submitted successfully');
        // If using APIs, you can return a JSON response instead
        // return response()->json(['message' => 'Comment submitted successfully', 'comment' => $comment]);
    }
}
