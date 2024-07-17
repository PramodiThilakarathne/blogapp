<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create the comment with user_id from the authenticated user
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id(); // Assign user_id from authenticated user

        $comment->save();

        return back()->with('comment_waiting', 'Comment is waiting for admin approval !');
    }

    public function index()
    {
        // Example logic to fetch comments and pass them to a view
        $comments = Comment::all(); // Adjust as per your application's logic
        
        return view('admin.comments', compact('comments'));
    }
}