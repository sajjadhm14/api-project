<?php

namespace Database\Seeders;

use App\Models\Select_option;
use App\Models\Selectoption;
use App\Models\Text_Answer;
use App\Models\TextAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TextAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\Question::all()->each(function ($question) {
            if ($question->type == 1) {
                Selectoption::factory(4)->create(['question_id' => $question->id]);
            } else {
                TextAnswer::factory()->create(['question_id' => $question->id]);
            }
        });
    }
}
