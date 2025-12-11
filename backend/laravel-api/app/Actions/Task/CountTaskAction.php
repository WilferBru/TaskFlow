<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class CountTaskAction
{

    public function execute(): array
    {
        //** @var \App\Models\User $user */
        $user = Auth::user();

        return [
            'total'   => Task::where('user_id', $user->id_user)->count(),
            'alta' => Task::where('user_id', $user->id_user)->where('priority', 'alta')->count(),
            'media' => Task::where('user_id', $user->id_user)->where('priority', 'media')->count(),
            'baja' => Task::where('user_id', $user->id_user)->where('priority', 'baja')->count(),
        ];
    }
}
