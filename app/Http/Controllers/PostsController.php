<?php

namespace App\Http\Controllers;


use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Auth;    
use App\Models\Post;
use App\Models\Tag;
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

        // Sync tags for the post
        $tags = $this->processTags($request->input('tags'));
        $post->tags()->sync($tags);
        
    
        return back()->withMessage('Your image has been uploaded!');
    }

    public function edit(Post $post)
    {
        // Fetch existing tags associated with the post and format them as a string
        $existingTags = $post->tags->pluck('name')->implode(',');

        return view('posts.edit', compact('post', 'existingTags'));
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

        // Sync tags for the post
        $tags = $this->processTags($request->input('tags'));
        $post->tags()->sync($tags);
    
        return redirect()->route('detail', ['post' => $post->id])->withMessage('Post updated successfully.');
    }
    
    private function processTags($tagsInput)
    {
        // Split the input string into individual words
        $tagsArray = preg_split('/\s+/', $tagsInput);

        // Remove any empty elements
        $tagsArray = array_filter($tagsArray);

        // Remove duplicates
        $tagsArray = array_unique($tagsArray);

        // Find existing tags and create new ones
        $tags = [];
        foreach ($tagsArray as $tagName) {
            // Check if tag already exists
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tags[] = $tag->id;
        }

        return $tags;
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

    public function index(Request $request)
    {
        $query = $request->input('query');
        $tag = $request->input('tag');

        // Filter images based on the search query
        $posts = Post::query();

        if ($query) {
            $posts->where('title', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%");
        }

        if ($tag) {
            $posts->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag);
            });
        }

        $posts = $posts->get();

        return view('home', compact('posts'));
    }
    
    public function show(Post $post)
    {
        $post->loadCount('likes'); // Eager load likes count
        return view('posts.detail', compact('post'));
    }
    
    public function showGuest(Post $post)
    {
        $post->loadCount('likes'); // Eager load likes count
        return view('posts.detail_guest', compact('post'));
    }

    public function like(Post $post)
    {
        $user = Auth::user();
        
        // Check if the user has already liked the post
        $existingLike = Like::where('user_id', $user->id)
                            ->where('post_id', $post->id)
                            ->first();
        
        if ($existingLike) {
            // User has already liked the post, so unlike it
            $existingLike->delete();
        } else {
            // User hasn't liked the post yet, so create a new like
            $like = new Like();
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            $like->save();
        }
        
        // Return updated likes count
        $likesCount = $post->likes()->count();
        return response()->json(['likesCount' => $likesCount]);
    }
    
    public function unlike(Post $post)
    {
        $user = Auth::user();
        
        // Find the like record for the user and post
        $existingLike = Like::where('user_id', $user->id)
                            ->where('post_id', $post->id)
                            ->first();
        
        if ($existingLike) {
            // Delete the like record
            $existingLike->delete();
        }
        
        // Return updated likes count
        $likesCount = $post->likes()->count();
        return response()->json(['likesCount' => $likesCount]);
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