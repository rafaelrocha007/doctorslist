<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_everyone_needs_to_be_redirected_to_react_login_when_404_error()
    {
        $response = $this->get('/my-non-existent-url');
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $password = Hash::make('123456');
        $user = factory(User::class)->create([
            'password' => $password,
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => '654321',
        ]);

        $response->assertStatus(401);

        $this->assertGuest();
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $password = Hash::make('my-password');

        $user = factory(User::class)->create([
            'password' => bcrypt($password),
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertAuthenticatedAs($user);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token', 'token_type', 'expires_in'
        ]);
    }

    public function test_logout()
    {
        $user = factory(User::class)->create();

        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/auth/logout?token=' . $token;

        $response = $this->json('POST', $baseUrl, []);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Successfully logged out'
            ]);
    }
}
