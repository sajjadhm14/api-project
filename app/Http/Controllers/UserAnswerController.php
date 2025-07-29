<?php

namespace App\Http\Controllers;

use App\Models\User_Answer;
use App\Http\Requests\StoreUser_AnswerRequest;
use App\Http\Requests\StoreUserAnswerRequest;
use App\Http\Requests\UpdateUser_AnswerRequest;
use App\Http\Requests\UpdateUserAnswerRequest;
use App\Http\Resources\UserAnswerResource;
use App\Models\UserAnswer;

class UserAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserAnswerResource::collection(UserAnswer::all());
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAnswerRequest $request)
    {
        $userAnswer = UserAnswer::create($request->validated());
        return new UserAnswerResource($userAnswer);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAnswer $userAnswer)
    {
        return new UserAnswerResource($userAnswer);
    }


    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAnswerRequest $request, UserAnswer $userAnswer)
    {
        $userAnswer->update($request->validated());
        return new UserAnswerResource($userAnswer);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAnswer $userAnswer)
    {
        $userAnswer->delete();
        return response()->json(['message' => 'User answer deleted successfully']);
    }
}
