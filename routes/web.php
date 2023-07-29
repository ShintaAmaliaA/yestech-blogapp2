<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\locationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\PublicWebController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');

    Route::prefix('blog/task')->name('blog.task.')->group(function () {
    Route::get('/task', [TaskController::class, 'index'])->name('task.index');
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/task/{id}/update', [TaskController::class, 'update'])->name('task.update');
    Route::get('/task/{id}/show', [TaskController::class, 'show'])->name('task.show');
    Route::get('/task/{id}/delete', [TaskController::class, 'delete'])->name('task.delete');

    });

    Route::prefix('blog/post')->name('blog.post.')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/{id}/update', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{id}/destroy', [PostController::class, 'destroy'])->name('posts.delete');

    });

    Route::prefix('blog/categories')->name('blog.categories.')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::get('{id}/destroy', [CategoryController::class, 'destroy'])->name('delete');
    });

});


//Route::get('', [PublicWebController::class, 'webpage'])->name('webpage');
Route::get('/', [PublicWebController::class, 'webpage'])->name('webpage');

Route::get('/location', [locationController::class, 'index'])->name('location.index');
Route::get('/ /public_pages', [PublicPageController::class, 'homepage'])->name('blog.public_pages.publicpages');
//Route::get('', [PublicPageController::class, 'blog.homepage'])->name('blog.homepage');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/{slug}', [PublicPageController::class, 'show'])->name('show');
