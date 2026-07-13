<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserBookController;
use App\Http\Controllers\Api\AuthController;

Route::group(['prefix' => 'auth'], function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => 'book'], function(){
    Route::middleware(['role:user'])->get('/', [BookController::class, 'index']);
    Route::get('/softDeleted', [BookController::class, 'getSoftDeleted']);
    Route::middleware(['role:user'])->get('/{id}', [BookController::class, 'show']);
    Route::post('/', [BookController::class, 'store']);
    Route::post('/restoreBook/{id}', [BookController::class, 'restore']);
    Route::middleware(['auth:sanctum', 'role:admin'])->put('/{id}', [BookController::class, 'update']);
    Route::middleware(['auth:sanctum', 'role:admin'])->delete('/{id}', [BookController::class, 'destroy']);
    Route::middleware(['auth:sanctum', 'role:admin'])->delete('/hardDelete/{id}', [BookController::class, 'hardDelete']);
});

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => 'user-book'], function(){
    Route::get('/', [UserBookController::class, 'index']);
});