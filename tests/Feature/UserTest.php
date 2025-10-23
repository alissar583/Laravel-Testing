<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register_create_user_and_return_user_and_token()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test1@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Registration successful'
        ])
            ->assertJsonStructure([
                'message',
                'user' => [
                    'id',
                    'name',
                    'email'
                ],
                'token'
            ]);


        $this->assertDatabaseHas('users', [
            'name' => 'Test1111 User',
            'email' => 'test1@test.com'
        ]);
        // $this->assertArrayHasKey('user', $response->json());
        // $this->assertArrayHasKey('token', $response->json());

    }

    public function test_register_validation_failed(){
        $response = $this->postJson('/api/register', [
            'name' => 'ssss',
            'email' => 'email@email.com',
            'password' => '11111111',
            'password_confirmation' => '11111111',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }
}
