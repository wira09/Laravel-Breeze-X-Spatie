<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin role
Route::get('admin', function () {
    return view('tulisan');
})->middleware(['auth', 'verified', 'role:admin']);

// penulis role
Route::get('penulis', function () {
    return view('tulisan');
})->middleware(['auth', 'verified', 'role:penulis|admin']);

// user role
Route::get('tulisan', function () {
    return view('tulisan');
})->middleware(['auth', 'verified', 'role_or_permission:lihat-tulisan|admin'])->name('tulisan');

require __DIR__ . '/auth.php';
