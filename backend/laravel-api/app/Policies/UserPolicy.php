<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function viewAny(User $user): bool
    {
        // Solo admin puede listar todos los usuarios
        return $user->role === 'admin';
    }

    public function view(User $user, User $model): bool
    {
        // Elsuuario solo puede ver sus datos pero admin puede verlos todos
        return $user->id === $model->id || $user->role === 'admin';
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function update(User $user, User $model): bool
    {
        // Admin puede editar a cualquiera, usuario solo puede editar su perfil
        return $user->role === 'admin' || $user->id === $model->id;
    }

    public function delete(User $user, User $model): bool
    {
        // Solo admin puede eliminar
        return $user->role === 'admin';
    }

    public function restore(User $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
