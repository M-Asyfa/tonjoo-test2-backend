<?php

// dd('api.php is being loaded'); // <- TEMP DEBUG

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;
use App\Models\Category;

Route::get('/ping', function () {
    return ['status' => 'API is working!'];
});

Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::get('/transactions/{id}', [TransactionController::class, 'show']);
Route::put('/transactions/{id}', [TransactionController::class, 'update']);
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);

Route::get('/categories', function () {
    return Category::all();
});