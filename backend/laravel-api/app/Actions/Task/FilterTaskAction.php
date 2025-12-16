<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class FilterTaskAction
{
    public function execute($filterCategory, $filterState, $filterSearch, $filterPriority)
    {
        //** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Task::with(['category', 'stateTask'])
            ->category($filterCategory)
            ->state($filterState)
            ->priority($filterPriority)
            ->search($filterSearch)
            ->where('user_id', $user->id_user);

        $tasks = $query->get();

        return $tasks;
    }
}
