<?php

namespace App\Actions\User;

use App\Models\User;

class StoreUserAction
{
    public function execute(array $data)
    {
        $user = User::create($data);

        return $user;
    }
}
