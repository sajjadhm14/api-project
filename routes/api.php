<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SelectOptionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TextAnswerController;
use App\Http\Controllers\UserAnswerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLessonsController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');




Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('category',CategoryController::class);
    Route::apiResource('lesson',LessonController::class);
    Route::apiResource('question',QuestionController::class);
    Route::apiResource('textAnswer',TextAnswerController::class);
    Route::apiResource('selectOption', SelectOptionController::class);
    Route::apiResource('userAnswers',UserAnswerController::class);
    Route::apiResource('userLessons',UserLessonsController::class);
    Route::get('user', [UserController::class, 'showAvatar']);
    Route::post('user', [UserController::class, 'storeAvatar']);
    Route::put('user', [UserController::class, 'updateAvatar']);
    Route::delete('user', [UserController::class, 'destroyAvatar']);
    Route::get('/lessons/{lesson}/banner', [LessonController::class, 'showBanner']);
    Route::post('lesson-banner', [LessonController::class ,'storeBanner']);

});



Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


