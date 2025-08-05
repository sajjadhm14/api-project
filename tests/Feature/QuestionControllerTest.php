<?php

namespace Tests\Feature;

use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
   use RefreshDatabase;

   public function test_it_can_list_questions()
   {
    Question::factory()->count(3)->create();
    $response = $this->getJson('/api/question');
    $response -> assertStatus(200)
              -> assertJsonCount(3,'data');
   }


   public function test_it_can_create_questions()
   {
    $data = ['name'=> 'testQuestion'];

    $response = $this->postJson('/api/question', $data);
    $response -> assertStatus(201)
              ->assertJsonPath('data.name', 'testQuestion');
    
    $this->assertDatabaseHas('questions', ['name'=> 'testQuestion']);
   }

   public function test_it_can_update_questions()
   {
    $question= Question::factory()->create();
    $response = $this->putJson("api/question/{$question->id}", ['name'=> 'updateQuestion']);
    $response -> assertStatus(200)
              -> assertJsonPath('data.name', 'updateQuestion');
    
    $this->assertDatabaseHas('questions', ['name'=> 'updateQuestion']);
   }

   public function test_it_can_delete_questions()
   {
    $question = Question::factory()->create();

    $response = $this->deleteJson("api/question/{$question->id}");
    $response ->assertStatus(204);
    
    $this->assertDatabaseMissing('questions',['id'=>$question->id]);
   }

}
