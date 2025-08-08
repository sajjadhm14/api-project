<?php

namespace Tests\Feature;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
       protected function User()
     {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user ;
     }

    use RefreshDatabase;
   public function test_it_can_list_lessons()
   {
     $this->User();
        Lesson::factory()->count(3)->create();

        $response = $this->getJson('api/lesson');

        $response -> assertStatus(200)
                  -> assertJsonCount(3,'data');

   }

   public function test_it_can_create_lessons()
   {
          $this->User();

        $data = ['name' => 'lessonTest'];

        $response = $this->postJson('api/lesson', $data);

        $response ->assertStatus(201)
                  ->assertJsonPath('data.name', 'lessonTest');

        $this -> assertDatabaseHas('lessons',['name'=> 'lessonTest']);
   }

   public function test_it_starts_lesson_with_questions()
   {
          $this->User();
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();
    $question = Question::factory()->create(['lesson_id' => $lesson->id]);

    $response = $this->actingAs($user)->postJson('/api/lesson', [
        'lesson_id' => $lesson->id,
    ]);

    $response->assertStatus(200)
             ->assertJsonPath('progress', 1)
             ->assertJsonFragment(['id' => $question->id]);
    
    $this->assertDatabaseHas('user_lessons', [
        'user_id' => $user->id,
        'lesson_id' => $lesson->id,
        'progress' => 1,
    ]);
   }


   public function test_it_can_update_lessons()
   {
          $this->User();
        $lesson = Lesson::factory()->create();

        $response = $this->putJson("/api/lesson/{$lesson->id}",['name' => 'updateLesson']);

        $response -> assertStatus(200)
                  ->assertJsonPath('data.name', 'updateLesson');
        $this-> assertDatabaseHas('lessons', ['name' => 'updateLesson']);

   }


   public function test_it_can_delete_lessons()
   {
          $this->User();
        $lesson = Lesson::factory()->create();

        $response = $this->deleteJson("api/lesson/{$lesson->id}");

        $response -> assertStatus(204);

        $this-> assertDatabaseMissing('lessons',['id'=>$lesson->id]);
   }
}
