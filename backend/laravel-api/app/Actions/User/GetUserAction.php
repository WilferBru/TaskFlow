<?php

namespace App\Actions\User;

use App\Models\User;

class GetUserAction
{
    public function execute()
    {
        $user = User::orderBy('id_user', 'desc')->get();

        return $user;
    }
}
