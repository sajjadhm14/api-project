<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuestionResource::collection(Question::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->validated());
        return new QuestionResource($question);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question )
    {
        return new QuestionResource($question);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question,$id)
    {
        $question->update($request->validated());
        return new QuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question,$id)
    {
        $question->delete();
        return response()->json(['message'=>'question is deleted']);
    }
}
