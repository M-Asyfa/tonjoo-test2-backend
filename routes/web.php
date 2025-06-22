<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Models\Category;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

// Route::get('/sanctum/csrf-cookie', function () {
//     return response()->json(['csrf' => csrf_token()]);
// });

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['web'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);
    Route::put('/transactions/{id}', [TransactionController::class, 'update']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
    Route::delete('/transactions/{header}/details/{detail}', [TransactionController::class, 'deleteDetail']);
});

Route::get('/categories', function () {
    return Category::all();
});