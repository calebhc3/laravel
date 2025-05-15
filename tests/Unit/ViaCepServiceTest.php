<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Services\ViaCepService;

class ViaCepServiceTest extends TestCase
{
    public function test_busca_endereco_funciona()
    {
        Http::fake([
            'viacep.com.br/ws/01001000/json/' => Http::response([
                'logradouro' => 'Praça da Sé',
                'bairro' => 'Sé',
                'localidade' => 'São Paulo',
                'uf' => 'SP'
            ], 200)
        ]);

        $service = new ViaCepService();
        $endereco = $service->buscarEndereco('01001-000');

        $this->assertEquals('Praça da Sé', $endereco['logradouro']);
        $this->assertEquals('Sé', $endereco['bairro']);
        $this->assertEquals('São Paulo', $endereco['localidade']);
        $this->assertEquals('SP', $endereco['uf']);
    }
}
