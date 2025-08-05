<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_list_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response -> assertStatus(200)
                  -> assertJsonCount(3, 'data');
    }

    public function it_can_create_category()
    {
        $data = ['name' => 'Test Category'];
        $response = $this->postJson('/api/categories', $data);

        $response ->assertStatus(201)
                  ->assertJsonPath('data.name', 'TestCategory');
        
        $this->assertDatabaseHas('categories', ['name'=> 'Test Category']);
    }

    public function it_can_update_category()
    {
        $category=Category::factory()->create();
        $response = $this->putJson('/api/categories/{$category->id}', [
            'name'=> 'updated Category',
        ]);
        $response ->assertStatus(200)
                  ->assertJsonPath('data.name','updated Category');
        $this->assertDatabaseHas('categories',['name' => 'updated Category']);
    }

    public function it_can_delete_category()
    {
        $category=Category :: factory()->create();

        $response = $this->deleteJson('/api/categories/{$category->id}');

        $response -> assertStatus(204);
        $this-> assertDatabaseMissing('categories',['id'=>$category->id]);
    }
}
