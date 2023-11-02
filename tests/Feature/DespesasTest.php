<?php

namespace Tests\Feature;

use App\Models\Despesa;
use \App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class DespesasTest extends TestCase
{
    /**
     * Teste: Criação de uma despesa
     * @return void
     */
    public function test_create_despesa(){
        $user = User::factory()->create();
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $parameters = [
            'descricao' => Str::uuid(),
            'data' => Carbon::now()->format('Y-m-d'),
            'valor' => rand(1, 300),
            'usuario' => $user->id
        ];

        $response = $this->postJson('/api/despesas-api', $parameters,[
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200);
    }

    /**
     * Teste: Consultando todas as despesas de um usuário
     * @return void
     */
    public function test_get_my_despesas(){
        $user = User::factory()->create();
        $usuario = $user->id;
        $token = $user->createToken(Str::uuid())->plainTextToken;

        Despesa::factory()->create(['usuario' => $usuario]);

        $response = $this->getJson('/api/despesas-api', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    /**
     * Teste: Consultando uma despesa do usuário
     * @return void
     */
    public function test_get_despesa(){
        $user = User::factory()->create();
        $usuario = $user->id;
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $despesa = Despesa::factory()->create(['usuario' => $usuario]);

        $response = $this->getJson("/api/despesas-api/{$despesa->id}", [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    /**
     * Teste: Excluindo uma despesa do usuário
     * @return void
     */
    public function test_destroy_despesa(){
        $user = User::factory()->create();
        $usuario = $user->id;
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $despesa = Despesa::factory()->create(['usuario' => $usuario]);

        $response = $this->delete('/api/despesas-api/'.$despesa->id, [], [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    /**
     * Teste: Atualizando uma despesa do usuário
     * @return void
     */
    public function test_update_despesa(){
        $user = User::factory()->create();
        $usuario = $user->id;
        $token = $user->createToken(Str::uuid())->plainTextToken;

        $despesa = Despesa::factory()->create(['usuario' => $usuario]);

        $parameters = [
            'descricao' => $despesa->descricao,
            'valor' => 90,
            'data' => $despesa->data,
            'usuario' => $despesa->usuario
        ];

        $response = $this->putJson('/api/despesas-api/'.$despesa->id, $parameters, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

}