<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\Panel\CatagoryController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\CommentController;
use App\Http\Controllers\CommentController as StoreCommentController;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\EditorUploadController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\SearchPostController;
use App\Http\Controllers\ShowPostCategory;
use App\Http\Controllers\ShowPostController;
use GuzzleHttp\Middleware;
use Whoops\Run;

use function PHPUnit\Framework\any;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// test 
// Route::

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/post/{post:slug}',[ShowPostController::class, 'show'])->name('post.show');
Route::get('/search',[SearchPostController::class, 'show'])->name('post.search');
Route::get('/category/{category:slug}', [ShowPostCategory::class, 'show'])->name('category.show'); 

Route::post('/comment',[StoreCommentController::class, 'store'])->middleware('auth')->name('comment.store');
Route::middleware('auth', 'throttle:like')->post('/like/{post:slug}', [LikePostController::class, 'store'])->name('like.post');

Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::middleware(['auth', 'admin'])->prefix('/panel')->group(function(){
    Route::resource('/users', UserController::class)->except('show');
    Route::resource('/categories', CategoryController::class)->except(['show', 'create']);
        Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
        Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
        Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    });
Route::middleware(['auth', 'author'])->prefix('/panel')->group(function(){
    Route::resource('/posts', PostController::class)->except('show');   
    Route::post('/editor/upload', [EditorUploadController::class, 'upload'])->name('editor-upload');
});

require __DIR__.'/auth.php';
