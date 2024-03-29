<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;

// Authentication routes
require __DIR__.'/auth.php';

// Homepage route
Route::get('/', function () {
    return auth()->check() ? redirect()->route('home') : view('welcome');
})->name('welcome');

// Homepage route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Welcome route
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Home route
Route::middleware(['auth', 'verified'])->get('/home', [HomeController::class, 'index'])->name('home');



// Post routes  
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts', [HomeController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::patch('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.delete');
    Route::get('/posts/{post}', [PostsController::class, 'show'])->name('detail');
    Route::post('/like/{post}', [PostsController::class, 'like'])->name('posts.like');
    Route::post('/unlike/{post}', [PostsController::class, 'unlike'])->name('posts.unlike');
    Route::post('/posts/{post}/comment', [PostsController::class, 'comment'])->name('posts.comment');
    Route::delete('/comments/{comment}', [PostsController::class, 'delete'])->name('comments.delete');
});





// Detail route for unauthenticated users
    Route::get('/posts/{post}/guest', [PostsController::class, 'showGuest'])->name('detail_guest');

// Dashboard route
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $posts = auth()->user()->posts;
    return view('dashboard', compact('posts'));
})->name('dashboard');  

// Profile routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Logout route (provided by Laravel's built-in authentication)
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Authentication routes
require __DIR__.'/auth.php';