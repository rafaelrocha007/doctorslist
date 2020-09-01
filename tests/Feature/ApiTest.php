<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_retrieve_without_token()
    {
        $response = $this->get('/api/specialties');
        die($response->status().'');
        $response->assertStatus(401);
    }

    public function test_user_retrieve_from_api_with_valid_token()
    {
        $user = factory(User::class)->create();

        $token = JWTAuth::fromUser($user);
        $response = $this->get('/api/specialties?token=' . $token);

        $response->assertStatus(200);
    }
}
