<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_logout_and_token_is_revoked(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        // LOGIN REAL
        $loginResponse = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ])->assertStatus(200);

        $token = $loginResponse->json('data.token');

        // LOGOUT con token real
        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/logout')
            ->assertStatus(200);

        // VALIDACIÓN CORRECTA DEL LOGOUT
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }
}
