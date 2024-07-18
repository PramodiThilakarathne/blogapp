<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    //
    public function store(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create the reply with user_id from the authenticated user
        $reply = new Reply();
        $reply->content = $request->input('content');
        $reply->comment_id = $comment->id;
        $reply->user_id = Auth::id(); // Assign user_id from authenticated user

        $reply->save();

        return back()->with('reply_waiting', 'Reply is waiting for admin approval!');
    }

    // public function approve(Reply $reply)
    // {
    //     $reply->approved = true;
    //     $reply->save();

    //     return back()->with('status', 'Reply approved successfully!');
    // }

    // public function reject(Reply $reply)
    // {
    //     $reply->delete();

    //     return back()->with('status', 'Reply rejected successfully!');
    // }

    public function index()
    {
        // Example logic to fetch comments and pass them to a view
        $comments = Comment::where('approved', false)->with(['post', 'user'])->get();
        $replies = Reply::where('approved', false)->with(['comment', 'user'])->get();

        return view('admin.replies', compact('comments', 'replies'));
    }
    
}
