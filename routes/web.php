<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
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

// ADMIN: kelola jobs, pelamar, export, import
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // kelola lowongan, kecuali index dan show (itu sudah untuk user di atas)
    Route::resource('jobs', JobController::class)->except(['index', 'show']);

    // daftar pelamar untuk suatu job
    Route::get('/jobs/{job}/applicants', [ApplicationController::class, 'index'])
        ->name('applications.index');

    // update status lamaran (Accepted / Rejected)
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])
        ->name('applications.update');

    // export pelamar ke Excel
    Route::get('/applications/export', [ApplicationController::class, 'export'])
        ->name('applications.export');

    // import lowongan dari file Excel
    Route::post('/jobs/import', [JobController::class, 'import'])
        ->name('jobs.import');
});

// USER: lihat daftar jobs dan apply (harus login)
Route::middleware(['auth'])->group(function () {
    // daftar lowongan untuk user
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

    // user apply ke job, upload CV
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])
        ->name('applications.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/kirim-email', [SendEmailController::class, 'index'])->name('kirim-email');
    Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');

    // optional alias /send-email, kalau tidak dipakai bisa dihapus
    Route::get('/send-email', [SendEmailController::class, 'index'])->name('kirim.email');
});

require __DIR__.'/auth.php';
