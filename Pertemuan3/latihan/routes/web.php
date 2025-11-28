<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Contoh Route untuk menampilkan view
Route::get('/', function () {
    return view('welcome');
}); 

// Contoh Route untuk menampilkan view
Route::get('/about', function () {
    return view('about');
});

// Contoh Route untuk menampilkan view
Route::get('/contact', function () {
    return view('contact');
});

// Contoh Route untuk menampilkan view
Route::get('/blog', function () {
    return view('blog');
});

// Route untuk memanggil method di PostController
route::get('/posts', [PostController::class, 'index']) -> name('posts.index');

// Route untuk menampilkan semua kategori
Route::get('/categories', [CategoryController::class, 'index']);
?>