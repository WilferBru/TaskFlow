<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateTaskRequest;
use App\Http\Resources\StateTaskResource;
use App\Models\StateTask;
use Illuminate\Http\Request;

class StateTaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(StateTask::class, 'state');
    }

    public function index()
    {
        return response()->json(StateTask::orderBy('id_state', 'asc')->get());
    }

    public function store(StateTaskRequest $stateRequest)
    {
        $state = StateTask::create($stateRequest->validated());

        return (new StateTaskResource($state))
            ->additional([
                'status'  => true,
                'message' => 'Estado creado correctamente',
            ]);
    }

    public function show(string $id)
    {
        //
    }

    public function update(StateTaskRequest $stateRequest, StateTask $state)
    {
        // $state = StateTask::findOrFail($id);

        $state->update($stateRequest->validated());


        return (new StateTaskResource($state))
            ->additional([
                'status'  => true,
                'message' => 'Estado actualizado correctamente',
            ]);
    }

    public function destroy(StateTask $state)
    {
        // $stateTask = StateTask::findOrFail($id);

        $state->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Estado borrado correctamente',
        ], 200);
    }
}
