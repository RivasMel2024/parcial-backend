<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase; // crea una base de datos temporal especificamente para las pruebas, y se borra al finalizar se elimina


    // TODA PRUEBA DEBE PASAR POR LOS PROXIMOS PRIMEROS PUNTOS
    public function test_it_can_login()
    {
        // Preparacion
        $user = User::factory()->create([
            'password' => bcrypt('test123'),
        ]);

        // Ejecucion
        $response = $this->post('/api/v1/login', [
            'email' => $user->email,
            'password' => 'test123',
        ]);

        // Verificacion
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'user',
        ]);

        $this->assertAuthenticatedAs($user);
    }
}