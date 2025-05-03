<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BinController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Routes untuk guest (belum login)
Route::middleware('guest')->group(function () {
    // Form Login & Proses
    Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Form Register & Proses
    Route::get('/register',  [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Routes untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Daftar sampah (halaman khusus)
    Route::get('/sampah', [BinController::class, 'index'])->name('sampah.index');

    // Resource routes untuk bins (CRUD)
    Route::resource('bins', BinController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});



// Fallback jika route tidak ketemu
Route::fallback(function () {
    return view('notfound');
});
