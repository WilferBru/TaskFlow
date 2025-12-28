<?php

namespace App\Actions\User;

use App\Models\User;

class UpdateUserAction
{
    public function execute(array $data, User $user)
    {
        $user->update($data);
        return $user;
    }
}
