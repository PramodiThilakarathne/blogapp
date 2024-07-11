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


    //user crud operations



    public function index()
    {
        $users = User::withCount('posts')->get();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('status', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->route('admin.users');
    }
}
