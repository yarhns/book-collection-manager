<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Halaman utama langsung arahkan ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// --- RUTE MODE DEMO (Bisa diakses tanpa login) ---
Route::get('/demo-login', function () {
    // Ambil user pertama di database (Admin)
    $admin = User::first();
    
    if ($admin) {
        Auth::login($admin); // Login otomatis
        session(['is_demo' => true]); // Tandai sebagai demo
        return redirect()->route('dashboard');
    }
    
    return redirect()->route('login')->with('error', 'Akun admin belum tersedia.');
})->name('demo.login');


// --- RUTE YANG WAJIB LOGIN ---
Route::middleware(['auth'])->group(function () {
    
    // ==========================================
    // 1. RUTE READ-ONLY (Bisa diakses Admin & Demo)
    // ==========================================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');


    // ==========================================
    // 2. RUTE MUTASI (Hanya untuk Admin, diblokir untuk Demo)
    // ==========================================
    Route::middleware(['demo'])->group(function () {
        // Buku
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
        
        // Kategori
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Profile
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Rute autentikasi bawaan Breeze (login, register, logout)
require __DIR__.'/auth.php';