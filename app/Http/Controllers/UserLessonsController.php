<?php

namespace App\Http\Controllers;

use App\Models\User_Lessons;
use App\Http\Requests\StoreUser_LessonsRequest;
use App\Http\Requests\StoreUserLessonsRequest;
use App\Http\Requests\UpdateUser_LessonsRequest;
use App\Http\Requests\UpdateUserLessonsRequest;
use App\Http\Resources\UserLessonResource;
use App\Models\UserLessons;
use GuzzleHttp\Psr7\Request;

class UserLessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserLessonResource::collection(UserLessons::all());
    }
    public function startlesson(StoreUserLessonsRequest $request)
    {
        
        $user = $request->user();
        $lesson_id = $request->validated()['lesson_id'];
        $userLesson = UserLessons::firstOrCreate([
            'user_id' => $user->id,
            'lesson_id' => $lesson_id,
         ], [
            'progress' => 1,  // مقدار پیشرفت رو 1 قرار می‌دهیم که یعنی درس شروع شده
         ]);

        // برگشت دادن وضعیت به کاربر
        return response()->json([
            'message' => 'درس با موفقیت شروع شد.',
            'progress' => $userLesson->progress, // پیشرفت 1 که یعنی درس شروع شده
        ]);
    
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserLessonsRequest $request)
    {
        $userLesson = UserLessons::create($request->validated());
        return new UserLessonResource($userLesson);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserLessons $userLessons)
    {
        return new UserLessonResource($userLessons);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserLessonsRequest $request, UserLessons $userLessons)
    {
        $userLessons->update($request->validated());
        return new UserLessonResource($userLessons);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserLessons $userLessons)
    {
        $userLessons->delete();
        return response()->json(['message' => 'UserLesson deleted successfully']);
    }
}
