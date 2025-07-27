<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');





Route::prefix('v2')->group(function () {
    Route::get('/tasks', [TaskController::class, 'indexV2']);
    
});


Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->middleware('auth:sanctum');
});



Route::prefix('category')->group(function(){
    Route::get('',[CategoryController::class , 'index']);
    Route::get('{id}',[CategoryController::class, 'show']);
    Route::post('',[CategoryController::class, 'store']);
    Route::put('{id}',[CategoryController::class, 'update']);
    Route::delete('{id}',[CategoryController::class, 'destroy']);
});