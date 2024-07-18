<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
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

        $posts = $query->latest()->paginate(6);
        $categories = Category::all();

        return view('welcome', compact('posts', 'categories'));
    }


    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Post::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('titles')) {
            $query->whereIn('id', $request->titles);
        }

        $posts = $query->paginate(6);

        return view('post', compact('categories', 'posts'));
    }

    // public function getTitlesByCategory($categoryId)
    // {
    //     $titles = Post::where('category_id', $categoryId)->get(['id', 'title']);
    //     return response()->json(['titles' => $titles]);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|string',
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

        return redirect()->route('dashboard')->with('post_store', 'Youre post is successfully created !!');
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

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
        }
        return redirect()->route('dashboard')->with('error', 'Post not found.');
    }

    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)
                           ->where('approved', true)
                           ->with(['user', 'replies' => function($query) {
                               $query->where('approved', true);
                           }, 'replies.user'])
                           ->get();

        return view('post-index', compact('post', 'comments'));
    }

    // public function storeComment(Request $request, Post $post)
    // {
    //     $request->validate([
    //         'content' => 'required|string',
    //     ]);

    //     $comment = new Comment();
    //     $comment->post_id = $post->id;
    //     $comment->user_id = Auth::id();
    //     $comment->content = $request->input('content');
    //     $comment->approved = false; // Default to false
    //     $comment->save();

    //     return redirect()->back()->with('message', 'Comment submitted for approval.');
    // }

    // public function storeReply(Request $request, Comment $comment)
    // {
    //     $request->validate([
    //         'content' => 'required|string',
    //     ]);

    //     $reply = new Reply();
    //     $reply->comment_id = $comment->id;
    //     $reply->user_id = Auth::id();
    //     $reply->content = $request->input('content');
    //     $reply->approved = false; // Default to false
    //     $reply->save();

    //     return redirect()->back()->with('message', 'Reply submitted for approval.');
    // }

}