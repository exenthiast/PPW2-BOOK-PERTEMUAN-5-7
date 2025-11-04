<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', [BookController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/jobs', function () {
    return "Halo Admin, ini halaman manajemen jobs.";
})->middleware(['auth', 'isAdmin'])->name('admin.jobs');

Route::get('/about', function () {
    return view('about');
});

// Management Users — hanya admin
Route::middleware(['auth', 'isAdmin'])->prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

// READ
Route::get('/buku', [BookController::class, 'index'])->name('buku.index');
Route::get('/buku/{id}', [BookController::class, 'show'])->name('buku.show');

// CRUD — hanya admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/buku/create', [BookController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BookController::class, 'store'])->name('buku.store');

    Route::get('/buku/{id}/edit', [BookController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [BookController::class, 'update'])->name('buku.update');

    Route::delete('/buku/{id}', [BookController::class, 'destroy'])->name('buku.destroy');
});

require __DIR__.'/auth.php';
