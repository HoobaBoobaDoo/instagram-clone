<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
public function createPost(Request $request) {
    $data = $request->validate([
        'title' => ['required'],
        'body' => ['required'],
        'image_path' => ['required', 'file', 'image'],
    ]);

    $data['title'] = strip_tags($data['title']);
    $data['body'] = strip_tags($data['body']);
    $data['user_id'] = auth()->id();

    if ($request->hasFile('image_path')) {
        $data['image_path'] = $request->file('image_path')->store('images', 'public');
    }

    Post::create($data);

    return redirect('/');
}

    public function editPost(Post $post) {
        if(auth()->id() !== $post->user_id) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

public function updatePost(Request $request, Post $post) {
    if(auth()->id() !== $post->user_id) {
        return redirect('/');
    }

    $data = $request->validate([
        'title' => ['required'],
        'body' => ['required'],
    ]);

    $data['title'] = strip_tags($data['title']);
    $data['body'] = strip_tags($data['body']);
    $data['image_path'] = $post->image_path; // keep the old image

    $post->update($data);

    return redirect('/');
}

    public function removePost(Request $request) {
        $post = Post::findOrFail($request->route('post'));

        if(auth()->id() !== $post->user_id) {
            return redirect('/');
        }

        $post->delete();

        return redirect('/');
    }
}
