<?php

namespace App\Http\Controllers;

use App\Models\Text_Answer;
use App\Http\Requests\StoreText_AnswerRequest;
use App\Http\Requests\StoreTextAnswerRequest;
use App\Http\Requests\UpdateText_AnswerRequest;
use App\Http\Requests\UpdateTextAnswerRequest;
use App\Http\Resources\TextAnswerResource;
use App\Models\TextAnswer;

class TextAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TextAnswerResource::collection(TextAnswer::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTextAnswerRequest $request)
    {
        $textAnswer = TextAnswer::create($request->validated());
        return new TextAnswerResource($textAnswer);
    }

    /**
     * Display the specified resource.
     */
    public function show(TextAnswer $textAnswer)
    {
        return new TextAnswerResource($textAnswer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTextAnswerRequest $request, TextAnswer $textAnswer)
    {
        $textAnswer ->update($request->validated());
        return new TextAnswerResource($textAnswer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TextAnswer $textAnswer)
    {
        $textAnswer->delete();
        return response()->json(['message'=> 'the textanswer deleted successfully']);
    }
}
