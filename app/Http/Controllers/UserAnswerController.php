<?php

namespace App\Http\Controllers;

use App\Models\User_Answer;
use App\Http\Requests\StoreUser_AnswerRequest;
use App\Http\Requests\StoreUserAnswerRequest;
use App\Http\Requests\UpdateUser_AnswerRequest;
use App\Http\Requests\UpdateUserAnswerRequest;
use App\Http\Resources\UserAnswerResource;
use App\Models\Question;
use App\Models\SelectOption;
use App\Models\TextAnswer;
use App\Models\UserAnswer;
use App\Models\UserLessons;
use App\Builders\UserAnswerBuilder;

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
        ->where('question_id',$data['Question_id'])
        ->exist();

        
        if ($exists){
            return response()->json(['message'=> "you have already answered question"]);
        }
        $iscorrect =false;

        if (!empty($data['select_question_id'])){
            $option = SelectOption::find($data['select_option_id']);
            $iscorrect = $option && $option->is_correct;
        }
        
        if (!empty($data['answer_text'])){
            $correctanswer = TextAnswer::where('question_id', $data['question_id'])->value('expected_answer');
            $iscorrect = strtolower(trim($correctanswer)) === strtolower($data['answer_text']);
        }

        $answer = UserAnswer::create([
            'user_id' =>$user->id,
            'question_id'=> $data['question_id'],
            'answer_text' => $data['answer_text'] ?? null,
            'select_option_id' =>$data['select_option_id'] ?? null,
            'points'=> $iscorrect ? 1 : 0,
        ]);

        $question = Question::find($data['question_id']);
        $this->updateLessonProgress($user->id, $question->lesson_id);

        return response()->json([
              'message' => $iscorrect ? "answer is correct" : 'answer is wrong',
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


    public function updatelessonprogress($userid, $lessonid)
    {
      $totalQuestions = Question::where('lesson_id', $lessonid)->count();

     if ($totalQuestions === 0) {
        return; 
     }
      $answeredQuestions = UserAnswer::where('user_id', $userid)
        ->whereIn('question_id', function ($query) use ($lessonid) {
            $query->select('id')
                  ->from('questions')
                  ->where('lesson_id', $lessonid);
        })->count();
      $progress = intval(($answeredQuestions / $totalQuestions) * 100);

     // به‌روزرسانی یا ساخت user_lessons
      UserLessons::updateOrCreate(
        ['user_id' => $userid, 'lesson_id' => $lessonid],
        ['progress' => $progress]
      );

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
