<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', [PostController::class, 'first'])->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');


Route::get('/dashboard', [PostController::class, 'userPosts'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

   
    Route::get('/post', [PostController::class, 'index'])->name('Post.index');
    Route::post('/post-store', [PostController::class, 'store'])->name('Post.store');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
   Route::get('/users/{user}/posts', [AdminController::class, 'viewUserPosts'])->name('admin.users.posts');
    Route::patch('/posts/{post}', [AdminController::class, 'updatePost'])->name('admin.post.update');
    Route::get('/admin/user_posts/{user}', [AdminController::class, 'viewUserPosts'])->name('admin.user.posts');


    Route::delete('/posts/{post}', [AdminController::class, 'destroyPost'])->name('admin.posts.destroy');
    Route::get('/posts/{post}/edit', [AdminController::class, 'editPost'])->name('admin.posts.edit');
    Route::get('/posts/{post}', [AdminController::class, 'showPost'])->name('admin.posts.show');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    //user crud routes

    // Route::get('users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}', [AdminController::class, 'show'])->name('admin.users.show');
    Route::get('users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::patch('users/{user}', [AdminController::class, 'update']);
    Route::delete('users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

});

require __DIR__.'/auth.php';

