<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

    ], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh',[AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('users', [UserController::class, 'store'])->name('users.store');

    });
    Route::middleware('auth:api')->group(function () {
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('users', [UserController::class, 'index'])->name('users.index');

        Route::post('posts', [PostController::class, 'store'])->name('posts.store');
        Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
        Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    });
