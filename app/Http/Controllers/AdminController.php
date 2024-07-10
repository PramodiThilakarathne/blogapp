<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function users(Request $request)
    {
        $query = User::withCount('posts');

        if ($request->has('category_id') && $request->category_id != '') {
            $query->whereHas('posts', function($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        $users = $query->get();
        $categories = Category::all();

        return view('admin.users', compact('users', 'categories'));
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
