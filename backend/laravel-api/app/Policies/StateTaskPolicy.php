<?php

namespace App\Policies;

use App\Models\StateTask;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StateTaskPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, StateTask $stateTask): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === "admin";
    }

    public function update(User $user, StateTask $stateTask): bool
    {
        return $user->role === "admin";
    }

    public function delete(User $user, StateTask $stateTask): bool
    {
        return $user->role === "admin";
    }

    public function restore(User $user, StateTask $stateTask): bool
    {
        return false;
    }

    public function forceDelete(User $user, StateTask $stateTask): bool
    {
        return false;
    }
}
