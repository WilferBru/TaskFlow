<?php

namespace App\Actions\User;

use App\Models\User;
use GuzzleHttp\Psr7\Request;

class UpdateUserAction
{
    public function execute(array $data, User $user)
    {
        $user->update($data);
        return $user;
    }
}
