<?php

namespace App\Actions\Task;

use Illuminate\Support\Facades\Auth;

class StoreTaskAction
{
    public function execute($data)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $task = $user->tasks()->create($data);

        return $task;
    }
}
