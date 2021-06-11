<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

//Route::get('/', function () {
//   return view('welcome');
//});

Route::get('/', [App\Http\Controllers\ThreadsController::class, 'showCategories'])->name('top');

Route::get('/categories/{category}', [Controllers\ThreadsController::class, 'showThreadList'])->name('category');
Route::get('/categories/{category}/{thread}', [Controllers\ThreadsController::class, 'showCommentList'])->name('thread');

Route::prefix('register')->group(function () {
    Route::get('comment', [Controllers\RegisterController::class, 'showAddComment'])->name('register.comment');
    Route::post('comment', [Controllers\RegisterController::class, 'addComment'])->name('register.comment');
    Route::get('thread', [Controllers\RegisterController::class, 'showAddThread'])->name('register.thread');
    Route::post('thread', [Controllers\RegisterController::class, 'addThread'])->name('register.thread');
});

Route::middleware('auth')->group(function () {
    Route::get('/delete_thread/{category}/{thread}', [Controllers\DeleteController::class, 'showDeleteThread'])
        ->name('delete.thread');
    Route::post('/delete_thread/{category}/{thread}', [Controllers\DeleteController::class, 'deleteThread'])
        ->name('delete.thread');
    Route::get('/delete_comment/{thread}/{comment}', [Controllers\DeleteController::class, 'showDeleteComment'])
        ->name('delete.comment');
    Route::post('/delete_comment/{thread}/{comment}', [Controllers\DeleteController::class, 'deleteComment'])
        ->name('delete.comment');
});

Route::get('/search',[Controllers\ThreadsController::class,'searchThreads'])->name('search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
