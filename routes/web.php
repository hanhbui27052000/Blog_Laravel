<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
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

Auth::routes();
Route::get('/logout','LoginController@logout');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

//route post
Route::middleware(['auth'])->group(function (){
    Route::resource('/post', PostController::class);
    Route::get('/post/my-all-posts/user/{id}', [UserController::class, 'my_all_post']);
    Route::get('/post/my-draft/user/{id}', [UserController::class, 'my_draft']);
});

Route::resource('/post', PostController::class)->only('show');
//route comment
Route::prefix('/comment')->middleware('auth')->group(function(){
    Route::post('/add', [CommentController::class, 'store']);
    Route::get('/delete/{id}', [CommentController::class, 'delete']);
});

Route::get('/user/{id}', [UserController::class, 'profile']);
Route::get('/user/{id}/post', [UserController::class, 'user_post_active']);

