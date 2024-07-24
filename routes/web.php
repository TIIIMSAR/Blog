<?php

use App\Http\Controllers\Panel\CatagoryController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\EditorUploadController;
use App\Http\Controllers\Panel\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\UserController;
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

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', function () {
    return view('/panel.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

Route::middleware(['auth', 'admin'])->prefix('/panel')->group(function(){
    Route::resource('/users', UserController::class)->except('show');
    Route::resource('/categories', CategoryController::class)->except(['show', 'create']);
    Route::resource('/posts', PostController::class)->except('show');
});
Route::middleware(['auth', 'author'])->prefix('/panel')->group(function(){
    Route::resource('/posts', PostController::class)->except('show');
    Route::post('/editor/upload', [EditorUploadController::class, 'upload'])->name('editor-upload');
});

require __DIR__.'/auth.php';
