<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProtectedRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_access_protected_route_without_token(): void
    {
        $response = $this->getJson('/api/profile');

        $response->assertStatus(401);
    }

    public function test_can_access_protected_route_with_valid_token(): void
    {
        $user = User::factory()->create(); // crear usuario de prueba

        Sanctum::actingAs($user); // simular un suario autenticado sin hacer login real

        $this->getJson('/api/profile')
            ->assertStatus(200)
            ->assertJsonFragment([
                'id_user' => $user->id_user,
                'email' => $user->email,
            ]);
    }
}
