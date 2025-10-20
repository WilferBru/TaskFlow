<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(UserRequest $userRequest)
    {
        // Como usamos UserRequest, ya viene validado automáticamente

        // Crear usuario
        $user = User::create($userRequest->validated()); // aqui simplificamos y editamso como request

        $token = $user->createToken('auth_token')->plainTextToken;

        return (new UserResource($user))
            ->additional([
                'status'  => true,
                'message' => 'Usuario agregado correctamente',
                'token' => $token,
            ]);
    }

    public function login(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->validated();

        if (!Auth::attempt($credentials, false)) {
            return response()->json([
                'status' => false,
                'message' => 'Credenciales inválidas, por favor revisa tu usuario y contraseña',
            ], 401);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return (new UserResource($user))
            ->additional([
                'status' => true,
                'message' => 'Inicio de sesión exitoso',
                'token' => $token,
            ]);
    }

    public function logout()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sesión cerrada correctamente',
        ]);
    }
}
