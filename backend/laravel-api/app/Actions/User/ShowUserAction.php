<?php

namespace App\Actions\User;

use App\Models\User;

class ShowUserAction
{
    public function execute(User $user)
    {
        // $user = User::findOrFail($user);

        return $user;
    }
}
