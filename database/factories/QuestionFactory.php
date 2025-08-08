<?php

namespace Database\Factories;
use app\enum\QuestionType;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => \App\Models\Lesson::factory(),
            'text' => $this->faker->text(5),
            'type' => $this->faker->randomElement([
            QuestionType::TEXT,
            QuestionType::SELECT
            ]),
            'difficulty' => rand(1, 3),
        ];
    }
}
