<?php

namespace Database\Seeders;

use App\Models\UserLessons;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                \App\Models\User::all()->each(function ($user) {
            $lessons = \App\Models\Lesson::inRandomOrder()->take(2)->get();
            foreach ($lessons as $lesson) {
                UserLessons::factory()->create([
                    'user_id' => $user->id,
                    'lesson_id' => $lesson->id,
                ]);
            }
        });
    }
    
}
