<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::where('user_id', auth()->id())->get();
        return view('albums.index', ['albums' => $albums]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the max file size as needed
        ]);
    
        $album = new Album();
        $album->title = $request->title;
        $album->description = $request->description;
        $album->user_id = auth()->id();
    
        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            $imagePath = $request->file('cover_image')->store('album_covers', 'public');
            $album->cover_image = $imagePath;
        }
    
        $album->save();
    
        return redirect()->route('albums.index')->with('success', 'Album created successfully.');
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the max file size as needed
        ]);
        
        try {
            $album->title = $request->title;
            $album->description = $request->description;

            if ($request->hasFile('cover_image')) {
                if ($album->cover_image) {
                    Storage::disk('public')->delete($album->cover_image);
                }
                $imagePath = $request->file('cover_image')->store('album_covers', 'public');
                $album->cover_image = $imagePath;
            }

            $album->save();

            return redirect()->route('albums.index')->with('success', 'Album updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update the album. Please try again.']);
        }
    }

    public function destroy(Album $album)
    {
        try {
            if ($album->cover_image) {
                Storage::disk('public')->delete($album->cover_image);
            }

            $album->delete();

            return redirect()->route('albums.index')->with('success', 'Album deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete the album. Please try again.']);
        }
    }
}
