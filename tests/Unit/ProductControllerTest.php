<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_a_new_product()
    {
        // Arrange: Prepare product data
        $productData = [
            'name' => 'New Product',
            'description' => 'Description of the new product',
            'price' => 99.99, // This is a valid float for price
            'quantity' => 10,
            'category_id' => 1,
        ];
        

        // Act: Make a POST request to store the product
        $response = $this->postJson('/api/store', $productData);

        // Assert: Check the response status
        $response->assertStatus(201); // Assuming your store method returns a 201 status for success

        // Assert: Verify the product was added to the database
        $this->assertDatabaseHas('products', [
            'name' => 'New Product',
            'price' => 99.99,
            'quantity' => 10,
            'category_id' => 1,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        // Seed categories or other necessary data before each test
        // $this->seed(); // Uncomment if you have a Category seeder
        // \App\Models\Category::factory()->create(['id' => 1, 'name' => 'Test Category']);
    }
}
