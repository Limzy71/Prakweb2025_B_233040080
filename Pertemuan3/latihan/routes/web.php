<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;

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

// Menampilkan semua kategori (Public)
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

// Route untuk menampilkan detail post (berdasarkan ID)
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Menampilkan daftar post & detail post (Public)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

// --- AUTHENTICATION (Login, Register, Logout) ---
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// --- DASHBOARD ADMIN (Wajib Login) ---
// 1. Route Categories
Route::resource('/dashboard/categories', AdminCategoryController::class)
    ->middleware('auth')
    ->names('dashboard.categories');

// 2. Route Dashboard Posts
// Index - Menampilkan semua posts milik user
Route::get('/dashboard', [DashboardPostController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.index');

// Create - Form untuk membuat post baru
Route::get('/dashboard/create', [DashboardPostController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.create');

// Store - Menyimpan post baru
Route::post('/dashboard', [DashboardPostController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.store');

// Show - Menampilkan detail post berdasarkan slug
Route::get('/dashboard/{post:slug}', [DashboardPostController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.show');

// Route untuk menampilkan form Edit
Route::get('/dashboard/{post:slug}/edit', [DashboardPostController::class, 'edit'])
    ->middleware('auth')
    ->name('dashboard.edit');

// Update
Route::put('/dashboard/{post:slug}', [DashboardPostController::class, 'update'])
    ->middleware('auth')
    ->name('dashboard.update');

// Destroy
Route::delete('/dashboard/{post:slug}', [DashboardPostController::class, 'destroy'])
    ->middleware('auth')
    ->name('dashboard.destroy');