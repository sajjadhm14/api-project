<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      

     $this->call([
        CategorySeeder::class,
        LessonSeeder::class,
        QuestionSeeder::class,
        SelectOptionSeeder::class,
        TextAnswerSeeder::class,
        UserSeeder::class,
        UserLessonsSeeder::class,
        UserAnswerSeeder::class,
    ]);

    }
}
