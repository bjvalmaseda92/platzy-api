<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_category_has_many_products()
    {
        /** @var User $user */
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(["category_id" => $category->id]);
        $this->assertInstanceOf(Collection::class, $category->products);
    }
}
