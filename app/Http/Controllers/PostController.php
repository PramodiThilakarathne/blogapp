<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function first()
    {
        $posts = Post::latest()->get(); // retrieve the 5 latest posts
        return view('welcome', compact('posts'));
    }

    public function index()
    {
        return view('post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:32',
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->save();

        return redirect()->route('dashboard');
    }

   
    public function userPosts()
    {
        $userPosts = Post::where('user_id', Auth::id())->get();
        $postCount = $userPosts->count();
        return view('dashboard', compact('userPosts', 'postCount'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to edit this post');
        }
        return view('edit-post', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to edit this post');
        }
        $request->validate([
            'title' => 'required|max:32',
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post updated Successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to delete this post');
        }
        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Post deleted Successfully!');
    }

    public function show(Post $post)
{
    return view('post.index', compact('post'));
}

}