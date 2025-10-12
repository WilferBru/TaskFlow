<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateTaskRequest;
use App\Http\Resources\StateTaskResource;
use App\Models\StateTask;
use Illuminate\Http\Request;

class StateTaskController extends Controller
{

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

    public function update(StateTaskRequest $stateRequest, $id)
    {
        $stateTask = StateTask::findOrFail($id);

        $stateTask->update($stateRequest->validated());


        return (new StateTaskResource($stateTask))
            ->additional([
                'status'  => true,
                'message' => 'Estado actualizado correctamente',
            ]);
    }

    public function destroy(String $id)
    {
        $stateTask = StateTask::findOrFail($id);

        $stateTask->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Estado borrado correctamente',
        ], 200);
    }
}
