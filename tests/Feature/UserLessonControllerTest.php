<?php

namespace Tests\Feature;

use App\Models\UserAnswer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLessonControllerTest extends TestCase
{
      use RefreshDatabase;

    public function test_it_can_list_UserAnswer()
    {
        UserAnswer :: factory()->count(3)->create();

        $response = $this->getJson('/api/userAnswer');
        $response -> assertStatus(200)
                  ->assertJsonCount(3,'data');
    }

    public function test_it_can_create_UserAnswer()
    {
        $data = ['name'=> 'testUserAnswer'];
        $response = $this->postJson('/api/UserAnswer',$data);

        $response -> assertStatus(201)
                  ->assertJsonPath('data.name',['name'=> 'testUserAnswer']);
        
        $this-> assertDatabaseHas('userAnswers', ['name'=> 'testUserAnswer']);
    }


    public function test_it_can_update_UserAnswer()
    {
        $userAnswer = UserAnswer :: factory()->create();
        $response = $this->putJson("api/textAnswer/{$userAnswer->id}", ['name'=> 'testUpdate']);

        $response ->assertStatus(200)
                  ->assertJsonPath('data.name','testUpdate');

        $this->assertDatabaseHas('userAnswers',['name'=>'testUpdate']);
    }

    public function test_it_can_delete_UserAnswer()
    {
        $userAnswer = UserAnswer::factory()->create();

        $response = $this->deleteJson("api/textAnswer/{$userAnswer->id}");

        $this->assertDatabaseMissing('userAnswers',['id'=>$userAnswer->id]);
    }
}
