<?php

namespace App\Http\Controllers;

use App\builders\LessonProgressBuilder;
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
use App\builders\UserAnswerUpdateBuilder;

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
            ->exist();


        if ($exists){
            return response()->json(['message'=> "you have already answered question"]);
        }
       
        $builder = new UserAnswerBuilder();
        $answer = $builder ->setUser($user)->setData($data)->save($user);

        $question = Question::find ($data['question_id']);
        $this->updateLessonProgress($user->id,$question->lesson_id);

    
        return response()->json([
            'message' => $builder->isCorrect() ? "answer is correct" : 'answer is wrong',
            'answer' => $answer,
        ]);

    }

    

    /**
     * Display the specified resource.
     */
    public function show(UserAnswer $userAnswer)
    {
        return new UserAnswerResource($userAnswer);
    }


    public function updateLessonProgress($userId, $lessonId)
    {
        $lessonProgressBuilder = new LessonProgressBuilder();
        $lessonProgressBuilder->update($userId->id,$lessonId);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAnswerRequest $request, UserAnswer $userAnswer)
    {
        $data = $request->validated();

        $updator = new UserAnswerBuilder();
        $updated = $updator->setUser($userAnswer->user) 
                            ->setData($data) 
                            ->save($userAnswer); 
        $this->updateLessonProgress($updated->user_id, $updated->question->lesson_id);

            return response()->json([
                'message' => $updator->isCorrect() ? 'Updated answer is correct' : 'Updated answer is incorrect',
                'answer' => $updated,
        ]);

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
