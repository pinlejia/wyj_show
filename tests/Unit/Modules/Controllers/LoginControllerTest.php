<?php

namespace Modules\Controllers;

use Illuminate\Foundation\Auth\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{

    public function testLogin()
    {
        $user = User::first();
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => '123456'
        ]);
        $response->dump();
        $response->assertStatus(200);

        $response = $this->getJson('/api/auth/user', [
            'authorization' => $response->json('token_type') . ' ' . $response->json('access_token')
        ]);

        $response->dump();
        $response->assertStatus(200);
    }
}
