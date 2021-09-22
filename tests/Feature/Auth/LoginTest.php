<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_validation_email()
    {
        $response = $this->postJson('/api/auth/login', [
            'password' => 'any password'
        ]);

        $response->assertStatus(400);
    }

    public function test_login_validation_password()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'admin@admin.com'
        ]);

        $response->assertStatus(400);
    }

    public function test_login_failed()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'admin@admin.com',
            'password' => 'wrong_password'
        ]);

        $response->assertStatus(401);
    }

//    public function test_sign_up_successfull()
//    {
//        $userData = [
//            "email" => "admin@admin.com",
//            "password" => "123123123",
//        ];
//
//        $this->json('POST', 'api/auth/login', $userData, ['Accept' => 'application/json'])
//            ->assertStatus(200);
//    }

}
