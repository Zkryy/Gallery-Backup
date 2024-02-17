<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    if (auth()->check()) {
        // If the user is authenticated, redirect them to the dashboard
        return redirect()->route('dashboard');
    } else {
        // If the user is not authenticated, show the welcome page
        return view('welcome');
    }
});

Route::post('/register', 'Auth\RegisterController@register');

Route::post('/login', 'Auth\LoginController@login');

Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

Route::get('/posts/{post}', [PostsController::class, 'show'])->name('detail');

Route::post('/posts/{post}/like', [PostsController::class, 'like'])->name('like.post');

Route::post('/posts/{post}/comment', [PostsController::class, 'comment'])->name('comment.post');


Route::get('/dashboard', function () {
    // Retrieve posts from the database
    $posts = \App\Models\Post::all();
    // Return the dashboard view with the $posts variable
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('web', 'auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

