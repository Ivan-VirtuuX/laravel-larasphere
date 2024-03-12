<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [PostController::class, 'posts'])->name('posts');
Route::get('/posts/popular', [PostController::class, 'popular'])->name('posts.popular');

Route::middleware('auth')->group(function () {
    Route::prefix('/posts')->name('posts.')->group(function () {
        Route::delete('/{post_id}', [PostController::class, 'destroy'])->name('post.delete');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/create', [PostController::class, 'store'])->name('store');
        Route::any('/toggle-like', [PostController::class, 'toggleLike'])->name('toggleLike');
        Route::any('/add-view', [PostController::class, 'addView'])->name('addView');
    });

    Route::get("/profile", [UserController::class, 'profile'])->name('profile.index');
    Route::patch('/profile', [UserController::class, "update"])->name('profile.update');
    Route::patch('/profile/update-avatar', [UserController::class, "updateAvatar"])->name('profile.updateAvatar');
});
