<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    public function test_sign_up_input_validation_failed()
    {
        $response = $this->postJson('/api/auth/register', []);

        $response->assertStatus(400);
    }

    public function test_sign_up_failed()
    {
        $response = $this->json('post', '/api/auth/register', [
            'name'  => 'Any Name',
            'email' => 'any@admin.com',
            'password' => '123123123',
            'password_confirmation' => '123'
        ]);

        $response->assertStatus(400);
    }

    public function test_sign_up_successfull()
    {
        $userData = [
            "name" => "User Name",
            "email" => "demo@demo.com",
            "password" => "123123123",
            "password_confirmation" => "123123123"
        ];

        $this->json('POST', 'api/auth/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertSee([
                'name',
                'email',
                'password',
            ]);
    }

}
