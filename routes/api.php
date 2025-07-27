<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');








Route::prefix('category')->group(function(){
    Route::get('',[CategoryController::class , 'index']);
    Route::get('{id}',[CategoryController::class, 'show']);
    Route::post('',[CategoryController::class, 'store']);
    Route::put('{id}',[CategoryController::class, 'update']);
    Route::delete('{id}',[CategoryController::class, 'destroy']);
});

Route::prefix('lesson')->group(function(){
    Route::get('',[LessonController::class , 'index']);
    Route::get('{id}',[LessonController::class, 'show']);
    Route::post('',[LessonController::class, 'store']);
    Route::put('{id}',[LessonController::class, 'update']);
    Route::delete('{id}',[LessonController::class, 'destroy']);
});