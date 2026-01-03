<?php

namespace App\Actions\Task;

use App\Models\Task;

class UpdateTaskAction
{
    public function execute($data, Task $task)
    {
        $task->update($data);
        $task->load(['category', 'StateTask']); // cargar relaciones

        return $task;
    }
}
