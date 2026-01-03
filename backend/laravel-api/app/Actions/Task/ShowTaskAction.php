<?php

namespace App\Actions\Task;

use App\Models\Task;

class ShowTaskAction
{
    public function execute(Task $task)
    {
        $task->with(['category', 'stateTask'])->get();

        return $task;
    }
}
