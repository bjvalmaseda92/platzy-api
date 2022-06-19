<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_product()
    {
        Product::factory()
            ->count(5)
            ->create();
        $this->get("api/products")
            ->assertSuccessful()
            ->assertJsonCount(5);
    }

    public function test_show_product()
    {
        $product = Product::factory()->create();
        $this->get("api/products/$product->id")->assertSuccessful();
    }

    public function test_create_product()
    {
        $data = [
            "name" => "Hola",
            "price" => 1000,
        ];

        $this->post("api/products", $data)->assertSuccessful();
        $this->assertDatabaseHas("products", $data);
    }

    public function test_update_product()
    {
        $product = Product::factory()->create();
        $data = [
            "name" => "Hola",
            "price" => 1000,
        ];

        $this->put("api/products/$product->id", $data)->assertSuccessful();
        $this->assertDatabaseHas("products", $data);
    }

    public function test_destroy_product()
    {
        $product = Product::factory()->create();

        $this->delete("api/products/$product->id")->assertSuccessful();
        $this->assertDatabaseMissing("products", $product->toArray());
    }
}
