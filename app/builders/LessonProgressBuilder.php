<?php

namespace App\builders;

use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserLessons;

class LessonProgressBuilder
{
    public function Update (int $userId , int $lessonId): void
    {
        $totalQuestions = Question::where('lesson_id',$lessonId)->count();
        if ($totalQuestions===0){
            return ;
        }
        $answeredQuestions = UserAnswer::where('user_id', $userId)
            ->whereIn('question_id', function ($query) use ($lessonId) {
                $query->select('id')
                    ->from('questions')
                    ->where('lesson_id', $lessonId);
            })->count();

        $progress = intval(($answeredQuestions / $totalQuestions) * 100);

        UserLessons::updateOrCreate(
            ['user_id' => $userId, 'lesson_id' => $lessonId],
            ['progress' => $progress]
        );
    }
    
}