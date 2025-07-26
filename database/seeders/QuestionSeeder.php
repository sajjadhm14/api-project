<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         \App\Models\Lesson::all()->each(function ($lesson) {
         \App\Models\Question::factory(3)->create(['lesson_id' => $lesson->id]);
        });
    }
}
