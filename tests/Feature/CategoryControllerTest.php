<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_category()
    {
        Category::factory()
            ->count(2)
            ->create();
        $this->get("api/categories")
            ->assertSuccessful()
            ->assertJsonCount(2);
    }

    public function test_show_category()
    {
        $category = Category::factory()->create();
        $this->get("api/categories/$category->id")->assertSuccessful();
    }

    public function test_create_category()
    {
        $data = [
            "name" => "Hola",
        ];

        $this->post("api/categories", $data)->assertSuccessful();
        $this->assertDatabaseHas("categories", $data);
    }

    public function test_update_category()
    {
        $category = Category::factory()->create();
        $data = [
            "name" => "Hola",
        ];

        $this->put("api/categories/$category->id", $data)->assertSuccessful();
        $this->assertDatabaseHas("categories", $data);
    }

    public function test_destroy_category()
    {
        $category = Category::factory()->create();

        $this->delete("api/categories/$category->id")->assertSuccessful();
        $this->assertDatabaseMissing("categories", $category->toArray());
    }
}
