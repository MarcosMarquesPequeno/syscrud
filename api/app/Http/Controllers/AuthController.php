<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'cpf' => 'required|max:11|unique:users,cpf',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'cpf' => $fields['cpf'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('api-access')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        // verifica se email existe
        $user = User::where('email', $fields['email'])->first();

        // verifica password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'errors' => [
                    'email' => ['As credenciais fornecidas estão incorretas.']
                ]
            ], 401);
        }

        $token = $user->createToken('api-access')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Deslogado'
        ];
    }
}
