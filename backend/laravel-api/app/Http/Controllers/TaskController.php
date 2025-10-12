<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index()
    {
        /** @var User $user */ // le decimos al IDE que Auth::user() devuelve un modelo User
        $user = Auth::user();

        $tasks = $user->tasks()->with(['category', 'stateTask'])->orderBy('id_task', 'desc')->get();

        return TaskResource::collection($tasks)
            ->additional([
                'status'  => true,
                'message' => 'Tareas obtenidas correctamente',
            ]);
    }

    public function store(TaskRequest $taskRequest)
    {
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Creamos la tarea usando la relación para que se rellene user_id automáticamente
            $task = $user->tasks()->create($taskRequest->validated());

            // Retornamos recurso + código 201 (created)
            return (new TaskResource($task))
                ->additional([
                    'status'  => true,
                    'message' => 'Tarea creada correctamente',
                ])->response()
                ->setStatusCode(201);
        } catch (\Throwable $e) {

            return response()->json([
                'status'  => false,
                'message' => 'No se pudo crear la tarea.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {

            /** @var \App\Model\User  */
            $user = Auth::user();

            $task = $user->tasks()->with(['category', 'stateTask'])->findOrFail($id);

            // $task = $user->tasks()->orderBy('id_task', 'desc')->get();;

            return (new TaskResource($task))
                ->additional([
                    'status'  => true,
                    'message' => 'Tarea obtenida correctamente',
                ])->response()
                ->setStatusCode(200);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error al consultar la tarea.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    public function update(TaskRequest $taskRequest, $id)
    {
        try {

            $task = Task::findOrFail($id);

            $task->update($taskRequest->validated());

            return (new TaskResource($task))
                ->additional([
                    'status'  => true,
                    'message' => 'Tarea actualizada correctamente'
                ])->response()
                ->setStatusCode(200);
        } catch (\Throwable $e) {

            return response()->json([
                'status'  => false,
                'message' => 'No se pudo actualizar la tarea.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {

            $task = Task::findOrFail($id);

            $task->delete();

            return response()->json(null, 204);
        } catch (\Throwable $e) {

            return response()->json([
                'status'  => false,
                'message' => 'No se pudo eliminar la tarea.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
