<?php

// app/Http/Controllers/Api/AdminController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total = User::count();
        $porCidade = User::select('cidade')->groupBy('cidade')->selectRaw('cidade, count(*) as total')->get();

        return response()->json([
            'total_usuarios' => $total,
            'usuarios_por_cidade' => $porCidade
        ]);
    }

    public function index(Request $request)
    {
        return User::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                      ->orWhere('email', 'like', "%{$request->search}%");
            })
            ->paginate(10);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'role' => 'sometimes|in:admin,user'
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return response()->json(['message' => 'Usuário atualizado', 'user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Usuário excluído']);
    }
}

