<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostCommentController extends Controller
{
    public function comment(Request $request, Post $post)
    {
        // Validate the comment data
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create a new comment for the post
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // Optionally, you can send notifications or perform other actions here

        // Return a success response
        return response()->json(['message' => 'Comment submitted successfully', 'comment' => $comment]);
    }
}
