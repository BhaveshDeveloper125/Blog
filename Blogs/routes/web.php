<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublishBlogs;
use App\Models\BlogData;
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

Route::get('/', function () {
      $category = BlogData::distinct()->inRandomOrder()->limit(10)->pluck('category');

        $blogs = BlogData::all();

        $blogs = $blogs->sortByDesc('created_at');

        return view('AllBlogList', ['blog' => $blogs, 'category' => $category]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/postBlog', [PublishBlogs::class, 'Blogs'])->name('submit.blog');
    Route::post('/upload-image', [PublishBlogs::class, 'uploadImage']);
    Route::post('/filter', [PublishBlogs::class, 'Filteration']);

    Route::view('/create_blog', 'Home');
    Route::get('/blogs/{id}', [PublishBlogs::class, 'SpecificBlog']);
    Route::get('/aboutblog/{id}', [PublishBlogs::class, 'AboutBlog']);
    Route::get('/filter', action: function () {
        return redirect('/');
    });
});
// Route::get('/allblogs', [PublishBlogs::class, 'GetBlogs']);

require __DIR__.'/auth.php';
