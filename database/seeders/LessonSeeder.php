<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        \App\Models\Category::all()->each(function ($category) {
         \App\Models\Lesson::factory(2)->create(['category_id' => $category->id]);
        });
    }
}
