<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class IndexTaskAction
{
    public function execute()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Task::with(['category', 'stateTask'])->orderBy('id_task', 'desc');

        if ($user->role === 'user') {
            $query->where('user_id', $user->id_user);
        }

        $tasks = $query->get();

        return $tasks;
    }
}
