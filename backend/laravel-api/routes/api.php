<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/profile', function () {
    return auth()->user();
});

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
// Route::post('/register', [AuthController::class, 'register'])->middleware('auth:sanctum');;
