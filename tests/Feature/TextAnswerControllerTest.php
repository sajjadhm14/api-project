<?php

namespace Tests\Feature;

use App\Models\TextAnswer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TextAnswerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function User()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
    public function test_it_can_list_TextAnswer()
    {
        $this->User();
        TextAnswer :: factory()->count(3)->create();

        $response = $this->getJson('/api/TextAnswer');
        $response -> assertStatus(200)
                  ->assertJsonCount(3,'data');
    }

    public function test_it_can_create_TextAnswer()
    {
        $this->User();
        $data = ['name'=> 'testTextAnswer'];
        $response = $this->postJson('/api/TextAnswer',$data);

        $response -> assertStatus(201)
                  ->assertJsonPath('data.name',['name'=> 'testTextAnswer']);
        
        $this-> assertDatabaseHas('textAnswers', ['name'=> 'testTextAnswer']);
    }


    public function test_it_can_update_TextAnswer()
    {
        $this->User();
        $textAnswer = TextAnswer :: factory()->create();
        $response = $this->putJson("api/textAnswer/{$textAnswer->id}", ['name'=> 'testUpdate']);

        $response ->assertStatus(200)
                  ->assertJsonPath('data.name','testUpdate');

        $this->assertDatabaseHas('textAnswers',['name'=>'testUpdate']);
    }

    public function test_it_can_delete_TextAnswer()
    {
        $this->User();
        $textAnswer = TextAnswer::factory()->create();

        $response = $this->deleteJson("api/textAnswer/{$textAnswer->id}");

        $this->assertDatabaseMissing('textAnswers',['id'=>$textAnswer->id]);
    }
}
