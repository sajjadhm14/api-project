<?php

namespace Tests\Feature;

use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{

    use RefreshDatabase;
   public function test_it_can_list_lessons()
   {
        Lesson::factory()->count(3)->create();

        $response = $this->getJson('api/lesson');

        $response -> assertStatus(200)
                  -> assertJsonCount(3,'data');

   }

   public function test_it_can_create_lessons()
   {
        $data = ['name' => 'lessonTest'];

        $response = $this->postJson('api/lesson', $data);

        $response ->assertStatus(201)
                  ->assertJsonPath('data.name', 'lessonTest');

        $this -> assertDatabaseHas('lessons',['name'=> 'lessonTest']);
   }

   public function test_it_can_update_lessons()
   {
        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/api/lesson/{$lesson->id}",['name' => 'updateLesson']);

        $response -> assertStatus(200)
                  ->assertJsonPath('data.name', 'updateLesson');
        $this-> assertDatabaseHas('lessons', ['name' => 'updateLesson']);

   }


   public function test_it_can_delete_lessons()
   {
        $lesson = Lesson::factory()->create();

        $response = $this->deleteJson("api/lesson/{$lesson->id}");

        $response -> assertStatus(204);

        $this-> assertDatabaseMissing('lessons',['id'=>$lesson->id]);
   }
}
