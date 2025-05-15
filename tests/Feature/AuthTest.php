<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_fazer_login_e_acessar_rota_protegida(): void
    {
        // Cria usuário fake no banco
        $user = User::create([
            'name' => 'Teste User',
            'email' => 'teste@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        // Faz login via POST /api/login
        $response = $this->postJson('/api/login', [
            'email' => 'teste@example.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());

        $token = $response->json('token');

        // Usa o token pra acessar rota protegida
        $protected = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->getJson('/api/me');

        $protected->assertStatus(200);
        $protected->assertJsonPath('email', 'teste@example.com');
    }
}
