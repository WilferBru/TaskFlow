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

        $query = Task::with(['category', 'stateTask'])->where('user_id', $user->id_user)->orderBy('id_task', 'desc');
        

        $tasks = $query->get();

        return $tasks;
    }
}
