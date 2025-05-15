<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public function buscarEndereco(string $cep): array
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response['erro'])) {
            throw new \Exception('CEP inválido ou não encontrado.');
        }

        return $response->json();
    }
}
