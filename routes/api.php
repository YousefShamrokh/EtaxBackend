<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserBookController;
use App\Http\Controllers\Api\AuthController;
use App\Models\Book;

Route::group(['prefix' => 'auth'], function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    Route::middleware(['signed'])->name('verification.verify')->get('/email/verify/{id}/{hash}', [AuthController::class,'verifyEmail']);
    Route::post('/email/verification-notification', [AuthController::class, 'resendMail']);
});

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'book'], function(){
    Route::group(['middleware' => ['role:admin']],function(){
        Route::get('/softDeleted', [BookController::class, 'getSoftDeleted']);
        Route::post('/', [BookController::class, 'store']);
        Route::get('/{id}/attachment', [BookController::class, 'getAttachmentForBook']);
        Route::post('/{id}/attachment', [BookController::class, 'uploadAttachment']);
        Route::post('/restoreBook/{id}', [BookController::class, 'restore']);
        Route::put('/{id}', [BookController::class, 'update']);
        Route::delete('/{id}', [BookController::class, 'destroy']);
        Route::delete('/hardDelete/{id}', [BookController::class, 'hardDelete']);
    });
        Route::get('/', [BookController::class, 'index']);
        Route::get('/{id}', [BookController::class, 'show']);
});

Route::group(['middleware' => ['auth:sanctum', 'role:admin'], 'prefix' => 'user-book'], function(){
    Route::get('/', [UserBookController::class, 'index']);
});