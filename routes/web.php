<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//route post
Route::middleware(['auth'])->group(function (){
    Route::resource('/post', PostController::class);
});

Route::resource('/post', PostController::class)->only('show');
//route comment
Route::prefix('/comment')->middleware('auth')->group(function(){
    Route::post('/add', [App\Http\Controllers\CommentController::class, 'store']);
    Route::get('/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete']);
});

Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'showPost']);