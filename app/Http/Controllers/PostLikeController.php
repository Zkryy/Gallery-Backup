<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;



class PostLikeController extends Controller
{
    public function like(Post $post)
    {
        // Check if the user has already liked the post
        if ($post->likes()->where('user_id', auth()->id())->exists()) {
            // Post is already liked by the user, return a response indicating that
            return response()->json(['message' => 'You have already liked this post'], 400);
        }

            // Create a new like for the post
            $like = $post->likes()->create([
                'user_id' => auth()->id(),
            ]);

            // Optionally, you can send notifications or perform other actions here

            // Return a success response
            return response()->json(['message' => 'Post liked successfully', 'like' => $like]);
    }

    public function unlike(Post $post)
    {
        // Check if the user has liked the post
        $like = $post->likes()->where('users_id', auth()->id())->first();

        if (!$like) {
            // User has not liked the post, return a response indicating that
            return response()->json(['message' => 'You have not liked this post'], 400);
        }

        // Delete the like
        $like->delete();

        // Optionally, you can perform other actions here

        // Return a success response
        return response()->json(['message' => 'Post unliked successfully']);
    }
}
