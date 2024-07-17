<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;

Route::get('/admin/comments', [CommentController::class, 'index'])->name('admin.comments');

//Route::post('/replies/{comment}', [ReplyController::class, 'store'])->name('replies.store');
Route::post('/replies/{reply}/approve', [ReplyController::class, 'approve'])->name('admin.replies.approve');
Route::post('/replies/{reply}/reject', [ReplyController::class, 'reject'])->name('admin.replies.reject');



Route::post('/contact', [ContactController::class, 'sendContactMessage'])->name('contact.send');
Route::get('/', [PostController::class, 'index'])->name('welcome');
Route::get('/get-titles-by-category/{categoryId}', [PostController::class, 'getTitlesByCategory']);

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

    //for the comments
    Route::post('/comments/{id}/approve', [AdminController::class, 'approveComment'])->name('admin.comments.approve');
    Route::post('/comments/{id}/reject', [AdminController::class, 'rejectComment'])->name('admin.comments.reject');
    Route::post('/replies/{id}/approve', [AdminController::class, 'approveReply'])->name('admin.replies.approve');
    Route::post('/replies/{id}/reject', [AdminController::class, 'rejectReply'])->name('admin.replies.reject');




    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/replies', [ReplyController::class, 'store'])->name('replies.store');
});

require __DIR__.'/auth.php';

