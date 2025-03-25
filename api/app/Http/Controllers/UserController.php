<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $user = User::create($validatedData);
        return response()->json($user, 201);
    }

    public function show(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user);
    }


    public function update(UserRequest $request, User $user): JsonResponse
    {
        $this->authorize('update', $user);

        $validatedData = $request->validated();
        $user->update($validatedData);

        return response()->json($user);
    }

    public function destroy(User $user): JsonResponse
    {

        $this->authorize('delete', $user); // Verifica se o usuário autenticado pode deletar o usuário

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }
}
