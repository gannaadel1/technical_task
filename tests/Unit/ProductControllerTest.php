<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
   
    use RefreshDatabase;
    /** @test */
    public function it_can_add_a_new_product()
    {
        $productData = [
            'name' => 'New Product',
            'description' => 'Description of the new product',
            'price' => 99.99,
            'category_id' => 1, 
        ];
        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(201); 
        $this->assertDatabaseHas('products', $productData);

        $this->seed(); 
        Product::factory()->create(['id' => 1, 'name' => 'Test Category']);
    }

}
