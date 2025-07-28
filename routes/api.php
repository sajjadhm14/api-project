<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuestionController;
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
    Route::get('{category}',[CategoryController::class, 'show']);
    Route::post('',[CategoryController::class, 'store']);
    Route::put('{category}',[CategoryController::class, 'update']);
    Route::delete('{category}',[CategoryController::class, 'destroy']);
});

Route::prefix('lesson')->group(function(){
    Route::get('',[LessonController::class , 'index']);
    Route::get('{lesson}',[LessonController::class, 'show']);
    Route::post('',[LessonController::class, 'store']);
    Route::put('{lesson}',[LessonController::class, 'update']);
    Route::delete('{lesson}',[LessonController::class, 'destroy']);
});
Route::prefix('question')->group(function(){
    Route::get('',[QuestionController::class , 'index']);
    Route::get('{question}',[QuestionController::class, 'show']);
    Route::post('',[QuestionController::class, 'store']);
    Route::put('{question}',[QuestionController::class, 'update']);
    Route::delete('{question}',[QuestionController::class, 'destroy']);
});