<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index']);
Route::get('/welcome', [PageController::class, 'welcome']);

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'service'])->name('service');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


// Route::get('/posts', [PageController::class, 'index'])->name('posts.index');
// Route::get('/posts/{post}', [PageController::class, 'show'])->name('posts.show');
// Route::get('/posts/create', [PageController::class, 'create'])->name('posts.create');
// Route::post('/posts/create', [PageController::class, 'store'])->name('posts.store');
// Route::get('/posts/{post}/edit', [PageController::class, 'edit'])->name('posts.edit');
// Route::put('/posts/{post}/edit', [PageController::class, 'update'])->name('posts.update');
// Route::delete('/posts/{post}/delete', [PageController::class, 'delete'])->name('posts.delete');

Route::resource('posts', PostController::class);
