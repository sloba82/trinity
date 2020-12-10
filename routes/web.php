<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('posts')->group(function () {
        Route::get('', [PostsController::class, 'index'])->name('post.index');
        Route::get('create', [PostsController::class, 'create'])->name('post.create');
        Route::get('edit/{id}', [PostsController::class, 'edit'])->name('post.edit');
        Route::post('store/{id?}', [PostsController::class, 'store'])->name('post.store');
        Route::delete('destroy/{id?}', [PostsController::class, 'destroy'])->name('post.destroy');
    });

    Route::prefix('news')->group(function () {
        Route::get('', [NewsController::class, 'index'])->name('news.index');
        Route::get('create', [NewsController::class, 'create'])->name('news.create');
        Route::get('edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
        Route::post('store/{id?}', [NewsController::class, 'store'])->name('news.store');
        Route::delete('destroy/{id?}', [NewsController::class, 'destroy'])->name('news.destroy');
    });

    Route::prefix('comments')->group(function () {
        Route::get('', [CommentController::class, 'index'])->name('comments.index');
        Route::get('/show/{id}', [CommentController::class, 'show'])->name('comments.show');
        Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('comments.edit');
        Route::get('create', [CommentController::class, 'create'])->name('comments.create');

        Route::post('/update/{id}', [CommentController::class, 'update'])->name('comment.update');

        Route::post('/enable/{id}', [CommentController::class, 'enable'])->name('comment.enable');
        Route::post('/disable/{id}', [CommentController::class, 'disable'])->name('comment.disable');
    });

    Route::prefix('reply')->group(function () {
        Route::delete('destroy/{id?}', [ReplyController::class, 'destroy'])->name('reply.destroy');
     });


});

require __DIR__.'/auth.php';

Route::get('', [FrontendController::class, 'home'])->name('home');
Route::get('/posts', [FrontendController::class, 'posts'])->name('posts');
Route::get('/posts/{id}', [FrontendController::class, 'postShow'])->name('post.show');
Route::get('/news', [FrontendController::class, 'news'])->name('news');
Route::get('/news/{id}', [FrontendController::class, 'newsShow'])->name('news.show');

Route::post('/post/comment/', [CommentController::class, 'storePost'])->name('post.comment.create');
Route::post('/news/comment/', [CommentController::class, 'storeNews'])->name('news.comment.create');
Route::post('reply/comment/{id}', [ReplyController::class, 'store'])->name('reply.create');


Route::get('/test', [TestController::class , 'index']);
