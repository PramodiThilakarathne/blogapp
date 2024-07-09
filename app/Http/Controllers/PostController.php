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
    $posts = Post::latest()->paginate(5); 

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
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update the post with the validated data
        $post->title = $validated['title'];
        $post->content = $validated['content'];

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }

            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            $post->image = $path;
        }

        // Save the updated post
        $post->save();

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('status', 'Post updated successfully!');
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
        return view('post-index', compact('post'));
    }

}