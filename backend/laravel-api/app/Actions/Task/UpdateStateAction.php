<?php

namespace App\Actions\Task;

use App\Models\Task;

class UpdateStateAction
{

    public function execute($dataState, Task $task)
    {
        $task->update([
            'state_id' => $dataState['state_id']
        ]);
        $task->load(['category', 'StateTask']); // cargar relaciones

        return $task;
    }
}
