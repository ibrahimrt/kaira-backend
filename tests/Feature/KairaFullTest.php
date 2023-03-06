<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class KairaFullTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        
        // Definimos los datos necesarios para la prueba
        $token = '{}';        
        $urlTotest = 'https://bcrypt-generator.com';
        
        // Hacemos una petición GET a la API para generar una URL acortada para la URL de prueba
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get(route('api.short-urls') . '?url=' . urlencode($urlTotest));
        
        // Verificamos que la respuesta tenga un código de estado HTTP 302 (Redirección)
        $response->assertStatus(Response::HTTP_FOUND);

        // Obtenemos la URL de redirección de la respuesta
        $redirectUrl = $response->headers->get('Location');
        
        // Verificamos que la URL de redirección no esté vacía
        $this->assertNotEmpty($redirectUrl);
        
        // Hacemos una petición GET a la URL de redirección obtenida
        $redirectResponse = $this->get($redirectUrl);

        // Comparamos la URL de redirección obtenida con la URL esperada
        $this->assertEquals('https://tinyurl.com/y6cj6kcu', $redirectUrl);
        
    }
}
