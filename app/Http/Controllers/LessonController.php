<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBannerRequest;
use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\LessonResource;
use App\Http\Resources\QuestionResource;
use App\Models\Category;
use App\Models\Question;
use App\Models\UserLessons;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LessonResource::collection(Lesson::all());
    }
    public function startLessonWithQuestion(StoreLessonRequest $request)
    {
        $user = $request -> user();
        $lesson_id = $request->validated()['lesson_id'];
        $userLesson = UserLessons::firstOrCreate([
            'user_id' => $user->id,
            'lesson_id' => $lesson_id,
        ],[
            'progress' => 1,
        ]);
        $questions = Question::with('options')
            ->where('lesson_id', $lesson_id)
            ->get();
        return response()->json([
            'message' => 'سلام عزیز درست شروع شد :)',
            'progress' => $userLesson->progress,
            'question' => QuestionResource::collection($questions),
        ]);
    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->validated());
        return new LessonResource($lesson->load('category'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson )
    {
        return new LessonResource($lesson->load('category')); 
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());
        return new LessonResource($lesson->load('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        
        $lesson->delete();
        return response()->json(['message' => 'lesson Deleted successfully']);
    }


}
