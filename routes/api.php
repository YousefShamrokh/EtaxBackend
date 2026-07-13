<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\AuthController;

Route::group(['prefix' => 'auth'], function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'user'], function () {
    Route::middleware('auth:sanctum', 'role:admin')->get('/', [UserController::class, 'getAll']);
    Route::middleware('auth:sanctum', 'role:admin')->get('/{id}', [UserController::class, 'find']);
    Route::middleware('auth:sanctum', 'role:admin')->post('/', [UserController::class, 'create']);
    Route::middleware('auth:sanctum', 'role:admin')->put('/{id}', [UserController::class, 'update']);
    Route::middleware('auth:sanctum', 'role:admin')->delete('/{id}', [UserController::class, 'delete']);
});

Route::group(['prefix' => 'book'], function(){
    Route::middleware('auth:sanctum', 'role:admin,user')->get('/', [BookController::class, 'getAll']);
    Route::middleware('auth:sanctum', 'role:admin')->get('/softDeleted', [BookController::class, 'getSoftDeleted']);
    Route::middleware('auth:sanctum', 'role:admin,user')->get('/{id}', [BookController::class, 'find']);
    Route::middleware('auth:sanctum', 'role:admin')->post('/', [BookController::class, 'create']);
    Route::middleware('auth:sanctum', 'role:admin')->post('/restoreBook/{id}', [BookController::class, 'restore']);
    Route::middleware('auth:sanctum', 'role:admin')->put('/{id}', [BookController::class, 'update']);
    Route::middleware('auth:sanctum', 'role:admin')->delete('/{id}', [BookController::class, 'delete']);
    Route::middleware('auth:sanctum', 'role:admin')->delete('/hardDelete/{id}', [BookController::class, 'hardDelete']);
});

Route::group(['prefix' => 'user-book'], function(){
    Route::middleware('auth:sanctum', 'role:admin,user')->get('/', [UserBookController::class, 'getAll']);
});