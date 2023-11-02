<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Teste: Testando validação de Login
     * @return void
     */
    public function test_validation_auth(){
        $response = $this->postJson('/api/auth/login/');
        $response->assertStatus(401);
    }

    /**
     * Teste: Testando validação de Login com um usuário inválido
     * @return void
     */
    public function test_validation_auth_fake_user(){
        $parameters = [
            'email' => 'numdata@numdata.com',
            'password' => bcrypt('67897987')
        ];

        $response = $this->postJson('/api/auth/login/', $parameters);
        $response->assertStatus(401);
    }

    /**
     * Teste: Testando validação de Login com um usuário correto
     * @return void
     */
    public function test_success_validation_auth(){
        $user = User::factory()->create();

        $parameters = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->postJson('/api/auth/login/', $parameters);
        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    /**
     * Teste: Testando logout
     * @return void
     */
    public function test_logout_api(){
        $user = User::factory()->create();
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $response = $this->postJson('/api/auth/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(204);
    }
}