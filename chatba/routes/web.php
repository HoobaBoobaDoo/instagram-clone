<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
});

/*User Authentication Routes
 */

Route::post('/register', UserController::class . '@register')->name('register');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/login', [UserController::class, 'login'])->name('login');

/* Posts stuff
*/

//Create post
Route::post('/create-post', [PostController::class, 'createPost'])->name('create.post');

//Show only your posts filter
Route::get('/show-your-posts', function () {
    $posts = [];
    if (auth()->check()) {
    $posts = auth()->user()->posts()->latest()->get();
    return view('home', ['posts' => $posts]);
    }
    return redirect('/')->with('error', 'You must be logged in to view your posts.');
});

//Show all posts
Route::get('/show-all-posts', function () {
    $posts = Post::all();
    return view('home', ['posts' => $posts]);
});

//Edit post page request
Route::get('/edit-post/{post}', [PostController::class, 'editPost'])->name('edit.post');

//Update post
Route::put('/update-post/{post}', [PostController::class, 'updatePost'])->name('edit.post');

//Delete post
Route::delete('/delete-post/{post}', [PostController::class, 'removePost'])->name('delete.post');