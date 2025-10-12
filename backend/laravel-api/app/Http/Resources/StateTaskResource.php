<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StateTaskResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id_state'   => $this->id_state,
            'state'      => $this->state,
            'created_at' => $this->created_at
        ];
    }
}
