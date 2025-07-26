<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_Lessons>
 */
class UserLessonsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'lesson_id' => \App\Models\Lesson::factory(),
            'progress' => rand(0, 100),
            'total_points' => rand(0, 100),
        ];
    }
}
