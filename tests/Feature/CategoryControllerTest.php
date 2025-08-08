<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function User()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user ;
    }

    public function it_can_list_categories()
    {
        $this->User();
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response -> assertStatus(200)
                  -> assertJsonCount(3, 'data');
    }

    public function it_can_create_category()
    {
        $this->User();
        $data = ['name' => 'Test Category'];
        $response = $this->postJson('/api/categories', $data);

        $response ->assertStatus(201)
                  ->assertJsonPath('data.name', 'Test Category');
        
        $this->assertDatabaseHas('categories', ['name'=> 'Test Category']);
    }

    public function it_can_update_category()
    {
        $this-> User();
        $category=Category::factory()->create();
        $response = $this->putJson("/api/categories/{$category->id}", [
            'name'=> 'updated Category',
        ]);
        $response ->assertStatus(200)
                  ->assertJsonPath('data.name','updated Category');
        $this->assertDatabaseHas('categories',['name' => 'updated Category']);
    }

    public function it_can_delete_category()
    {
        $this->User();
        $category=Category :: factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response -> assertStatus(204);
        $this-> assertDatabaseMissing('categories',['id'=>$category->id]);
    }
}
