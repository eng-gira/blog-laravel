<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest'); // only a guest can visit this page
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth'); // only an authenticated user
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->middleware('auth');

// Route Middleware Group: Admin
Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
    // Route::get('admin/posts', [AdminPostController::class, 'index']);
    // Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    // Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    // Route::post('admin/posts', [AdminPostController::class, 'store']);
    // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    // Route::delete('admin/posts/{post}', [AdminPostController::class, 'delete']);
});


// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view("posts", [
//         "posts" => $category->posts->load(['category', 'author']),
//         "categories" => Category::all(),
//         "currentCategory" => $category
//     ]);
// })->name("category");

// Route::get('/authors/{author:username}', function (User $author) {
//     return view("posts.index", [
//         "posts" => $author->posts->load(['category', 'author'])
//     ]);
// });
