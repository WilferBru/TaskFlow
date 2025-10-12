<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id_task'     => $this->id_task,
            'user_id'     => $this->user_id,
            'state_id'    => $this->state_id,
            'category_id' => $this->category_id,
            'title'       => $this->title,
            'description' => $this->description,
            'metadata'    => $this->metadata,
            'category'    => $this->category ? $this->category->category : null,
            'state'       => $this->stateTask ? $this->stateTask->state : null,
            'due_date'    => $this->due_date,
            'created_at'  => $this->created_at,
        ];
    }
}
