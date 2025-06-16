<?php

use App\Http\Controllers\PublishBlogs;
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
    return view('Home');
});

Route::post('/postBlog', [PublishBlogs::class, 'Blogs']);

Route::view('/blogs', 'DisplayBlogs');
Route::view('/allblogs', 'AllBlogList');
Route::view('/aboutblog', 'AboutBlog');
