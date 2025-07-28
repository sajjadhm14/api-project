<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\LessonResource;
use App\Models\Category;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LessonResource::collection(Lesson::all());
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
