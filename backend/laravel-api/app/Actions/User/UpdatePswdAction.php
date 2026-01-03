<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdatePswdAction
{
    public function execute(array $data, User $user): User
    {
        if (!Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['La contraseña actual no es correcta'],
            ]);
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}
