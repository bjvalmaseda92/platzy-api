<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_product_has_category()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(["category_id" => $category->id]);
        $this->assertInstanceOf(Category::class, $product->category);
    }

    public function test_product_has_create_by_user()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(["user_id" => $user->id]);
        $this->assertInstanceOf(User::class, $product->create_by);
    }
}
