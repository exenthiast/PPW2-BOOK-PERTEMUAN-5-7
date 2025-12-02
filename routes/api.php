<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookApiController;

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('books', BookApiController::class);
// });

Route::apiResource('books', BookApiController::class);
