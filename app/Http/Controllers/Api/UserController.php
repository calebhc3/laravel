<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\ViaCepService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(StoreUserRequest $request, ViaCepService $viaCep)
    {
        $data = $request->validated();
        $endereco = $viaCep->buscarEndereco($data['cep']);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cep' => $data['cep'],
            'numero' => $data['numero'],
            'rua' => $endereco['logradouro'] ?? null,
            'bairro' => $endereco['bairro'] ?? null,
            'cidade' => $endereco['localidade'] ?? null,
            'estado' => $endereco['uf'] ?? null,
            'role' => 'user',
        ]);

        return new UserResource($user);
    }
}
