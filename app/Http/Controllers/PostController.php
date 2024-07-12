<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function first(Request $request)
    {
        $query = Post::query();

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // if ($request->has('author') && $request->author) {
        //     $query->whereHas('user', function($q) use ($request) {
        //         $q->where('name', 'like', '%' . $request->author . '%');
        //     });
        // }

        // if ($request->has('date') && $request->date) {
        //     $query->whereDate('created_at', $request->date);
        // }

        $posts = $query->latest()->paginate(5);
        $categories = Category::all();

        return view('welcome', compact('posts', 'categories'));
    }


    public function index()
    {
        $query = Post::query();
        $posts = $query;
        $categories = Category::all();

        return view('post', compact('posts', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', 
            'image' => 'nullable|image|max:2048'
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->category_id = $request->input('category_id'); 
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

   
    public function userPosts(Request $request)
    {
        $query = Post::where('user_id', Auth::id());

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('author') && $request->author) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->author . '%');
            });
        }

        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $userPosts = $query->get();
        $postCount = $userPosts->count();
        $categories = Category::all();

        return view('dashboard', compact('userPosts', 'postCount', 'categories'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to edit this post');
        }
        $categories = Category::all();
        return view('edit-post', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update the post with the validated data
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->category_id = $request->input('category_id');

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