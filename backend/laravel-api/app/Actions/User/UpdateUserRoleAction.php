<?php 

namespace App\Actions\user;

use App\Models\User;

class UpdateUserRoleAction {
    public function execute(array $data, User $user): User
    {
        $user->update([
            'role' => $data['role'],
        ]);

        return $user;
    }
}