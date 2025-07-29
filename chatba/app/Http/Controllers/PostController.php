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
        ]);

        $data['title'] = strip_tags($data['title']);
        $data['body'] = strip_tags($data['body']);
        $data['user_id'] = auth()->id();

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
        else {
        $data = $request->validate([
            'title' => ['required'],
            'body' => ['required'],
        ]);
        }

        $data['title'] = strip_tags($data['title']);
        $data['body'] = strip_tags($data['body']);

        $post->update($data);

        return redirect('/');
    }

    public function removePost(Request $request) {
        $post = Post::findOrFail($request->route('post'));

        if(auth()->id() !== $post->user_id) {
            return redirect('/');
        }

        $post->delete();

        return redirect('/')->with('success', 'Post deleted successfully.');
    }
}
