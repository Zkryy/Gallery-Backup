<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Post;
use Illuminate\Http\Request;

class AlbumImageController extends Controller
{
    // Method to add images to an album
    public function addImage(Request $request, Album $album)
    {
        // Validate the request
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        // Attach the post (image) to the album
        $album->posts()->attach($request->post_id);

        return redirect()->back()->with('success', 'Image added to album successfully.');
    }

    // Method to remove images from an album
    public function removeImage(Album $album, Post $post)
    {
        // Detach the post (image) from the album
        $album->posts()->detach($post->id);

        return redirect()->back()->with('success', 'Image removed from album successfully.');
    }
}

