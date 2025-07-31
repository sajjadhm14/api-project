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
      $user = $request->user();
      $data = $request->validated();

      $exists = UserAnswer::where('user_id',$user->id)
        ->where('question_id',$data['question_id'])
        ->exists();
    if ($exists){
        return response()->json(['message' => 'you have already answered questino']);
    
    }
    $answer =UserAnswer::create([
        'user_id' =>$user->id,
        'question_id'=> $data['question_id'],
        'answer_text' => $data['answer_text'] ??null,
        'select_option_id' =>$data['select_option_id'] ?? null,
        'points'=> 0,
    ]);

    return response()->json([
        'message' => 'your answer is done',
        'answer'=>$answer,
    ]);

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
