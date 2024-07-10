<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::withCount('posts')->get();
        return view('admin.users', compact('users'));
    }

    public function viewUserPosts(User $user)
    {
        $posts = $user->posts()->get();
        return view('admin.user_posts', compact('user', 'posts'));
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return back()->with('status', 'Post deleted successfully');
    }

    public function editPost(Post $post)
    {
        return view('admin.edit_post', compact('post'));
    }

    public function showPost(Post $post)
    {
        return view('admin.show_post', compact('post'));
    }
}
