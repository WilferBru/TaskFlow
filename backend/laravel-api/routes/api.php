<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StateTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// -------------------------------------------------------------------------
// Rutas de Autenticación
// -------------------------------------------------------------------------

Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/profile', fn() => Auth::user()); //datos del user autenticado
    Route::post('/logout', [AuthController::class, 'logout']);

    // ruta de usuarios
    Route::patch('/users/{user}/role', [UserController::class, 'changeRol']);
    Route::patch('/users/{user}/changePassword', [UserController::class, 'changePassword']);
    Route::apiResource('/users', UserController::class);

    // -------------------------------
    // Rutas de StateTask
    // --------------------------------

    Route::apiResource('/states', StateTaskController::class);

    // --------------------------------
    // Rutas Category
    // --------------------------------

    Route::apiResource('/categories', CategoryController::class);

    // --------------------------------
    // Rutas Task
    // --------------------------------

    Route::get('/tasks/summary', [TaskController::class, 'summary']);
    Route::get('/tasks/filter', [TaskController::class, 'filter']);
    Route::put('/tasks/updateState/{task}', [TaskController::class, 'updateState']);
    Route::apiResource('/tasks', TaskController::class);
});
