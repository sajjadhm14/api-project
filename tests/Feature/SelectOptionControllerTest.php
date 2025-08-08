<?php

namespace Tests\Feature;

use App\Models\SelectOption;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SelectOptionControllerTest extends TestCase
{
   use RefreshDatabase;
      protected function User()
      {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
      }

   public function test_it_can_list_selectOption()
   {
      $this->User();
    SelectOption::factory()->count(3)->create();

    $response = $this->getJson('api/SelectOption/');

    $response ->assertStatus(200)
              ->assertJsonCount(3,'data');

   }

   public function test_it_can_create_selectOption()
   {
            $this->User();
    $data = ['name'=> 'testSelectOption'];
    $response = $this->postJson('/api/selectOption',$data);

    $response ->assertStatus(201)
              ->assertJsonPath('data.name',['name'=> 'testSelectOption']);
    
    $this->assertDatabaseHas('selectOptions',['name' => 'testSelectOption']);
   }


   public function test_it_can_update_selectOption()
   {
            $this->User();
    $selectOption = SelectOption::factory()->create();

    $response = $this->putJson("api/selectOption/{$selectOption->id}",['name'=>'updateSelectOption']);

    $response ->assertStatus(200)
              ->assertJsonPath('data.name', 'updateSelectOption');
            
    $this->assertDatabaseHas('selectOptions',['name'=> 'updateSelectOption']);
   }


   public function test_it_can_delete_selectOption()
   {
            $this->User();
    $selectOption = SelectOption::factory()->create();
    $response = $this->deleteJson("api/selectOption/{$selectOption->id}");

    $response ->assertStatus(204);
    
    $this-> assertDatabaseMissing('selectOptions',['id'=>$selectOption->id]);
    
   }
}
