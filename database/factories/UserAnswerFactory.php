<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User_Answer>
 */
class UserAnswerFactory extends Factory
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
            'question_id' => \App\Models\Question::factory(),
            'answer_text' => $this->faker->sentence(),
            'points' => rand(0, 10),
        ];
    }
}
