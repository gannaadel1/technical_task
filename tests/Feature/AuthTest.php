<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase; 

    public function it_can_login_with_valid_credentials()
    {
         User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'), 
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200); 
        $this->assertArrayHasKey('token', $response->json()); 
    }

  
    public function it_cannot_login_with_invalid_credentials()
    {
       
        User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'), 
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401); 
        $response->assertJson([
            'message' => 'Unauthorized', 
        ]);
    }
}

