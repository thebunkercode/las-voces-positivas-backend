<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('users')->group(function () {
    Route::post('create', [\App\Http\Controllers\Users::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Users::class, 'login']);
    Route::patch('update', [\App\Http\Controllers\Users::class, 'update']);
});

Route::prefix('posts')->group(function () {
    Route::get('list', [\App\Http\Controllers\PostsController::class, 'list']);
    Route::put('create', [\App\Http\Controllers\PostsController::class, 'create'])
        ->middleware('auth:sanctum');
});

Route::prefix('comments')->group(function () {
    Route::post('create', [\App\Http\Controllers\CommentController::class, 'create'])
        ->middleware('auth:sanctum');
});

