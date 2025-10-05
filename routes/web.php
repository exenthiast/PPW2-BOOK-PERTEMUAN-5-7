<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/buku', [BookController::class, 'index'])->name('buku.index');
Route::get('buku/create', [BookController::class, 'create'])->name('buku.create');
Route::post('/buku', [BookController::class, 'store'])->name('buku.store');

Route::delete('/buku/{id}', [BookController::class, 'destroy'])->name('buku.destroy');

Route::get('/buku/{id}/edit', [BookController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}', [BookController::class, 'update'])->name('buku.update');