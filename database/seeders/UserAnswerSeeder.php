<?php

namespace Database\Seeders;

use App\Models\UserAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\User::all()->each(function ($user) {
            $lessons = $user->lessons->pluck('lesson_id');
            $questions = \App\Models\Question::whereIn('lesson_id', $lessons)->get();

            foreach ($questions as $question) {
                if ($question->type == 1) {
                    $option = $question->options->random();
                    UserAnswer::create([
                        'user_id' => $user->id,
                        'question_id' => $question->id,
                        'selected_option_id' => $option->id,
                        'points' => $option->is_correct ? 10 : 0,
                    ]);
                } else {
                    UserAnswer::create([
                        'user_id' => $user->id,
                        'question_id' => $question->id,
                        'answer_text' => 'پاسخ  کاربر',
                        'points' => rand(0, 10),
                    ]);
                }
            }
        });
    }
}
