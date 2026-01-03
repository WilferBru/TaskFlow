<?php

namespace App\Http\Controllers;

use App\Actions\Task\CountTaskAction;
use App\Actions\Task\DeleteTaskAction;
use App\Actions\Task\FilterTaskAction;
use App\Actions\Task\IndexTaskAction;
use App\Actions\Task\ShowTaskAction;
use App\Actions\Task\StoreTaskAction;
use App\Actions\Task\UpdateStateAction;
use App\Actions\Task\UpdateTaskAction;
use App\Http\Requests\FilterTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Http\Resources\TaskResource;
use App\Http\Responses\apiResponse;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(IndexTaskAction $indextask)
    {
        try {

            $tasks = $indextask->execute();

            return apiResponse::success(
                TaskResource::collection($tasks),
                'Tareas obteneidas correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al obtener las tareas',
                $e,
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function summary(CountTaskAction $countTask)
    {
        $this->authorize('summary', Task::class);

        try {

            $task = $countTask->execute();

            return apiResponse::success(
                $task,
                'Conteo de tareas obtenido correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al obtener el conteo de tareas',
                $e,
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function filter(FilterTaskRequest $filterTaskRequest, FilterTaskAction $filterTask)
    {

        $this->authorize('filter', Task::class);

        try {

            $tasks = $filterTask->execute(
                $filterTaskRequest->category_id,
                $filterTaskRequest->state_id,
                $filterTaskRequest->keyword,
                $filterTaskRequest->priority
            );

            return apiResponse::success(
                TaskResource::collection($tasks),
                $tasks->isEmpty()
                ? 'No se encontraron tareas con esos filtros.'
                : 'Tareas obtenidas correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {

            return apiResponse::error(
                'Error al obtener las tareas',
                $e,
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function store(TaskRequest $taskRequest, StoreTaskAction $storeTask)
    {
        try {

            $task = $storeTask->execute($taskRequest->validated());

            return apiResponse::success(
                new TaskResource($task),
                'Tarea guardada correctamente',
                JsonResponse::HTTP_CREATED
            );
        } catch (\Throwable $e) {

            return apiResponse::error(
                'Error al crear la tarea',
                $e,
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function show(Task $task, ShowTaskAction $showTask)
    {
        try {

            $taskData = $showTask->execute($task);

            return apiResponse::success(
                new TaskResource($taskData),
                'Tarea obteneida correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al obtener la tarea',
                $e,
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function updateState(UpdateStateRequest $request, Task $task, UpdateStateAction $updateState)
    {
        $this->authorize('updateState', $task);

        try {
            $state = $updateState->execute($request->validated(), $task);

            return apiResponse::success(
                new TaskResource($state),
                'Estado de la tarea actualizada',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al actualizar el estado de la tarea',
                $e,
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function update(TaskRequest $taskRequest, Task $task, UpdateTaskAction $updateTask)
    {
        try {

            $taskData = $updateTask->execute($taskRequest->validated(), $task);

            return apiResponse::success(
                new TaskResource($taskData),
                'Tarea Actualizada correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al actualizar la tarea',
                $e,
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    public function destroy(Task $task, DeleteTaskAction $deleteTask)
    {
        try {

            $deleteTask->execute($task);

            return apiResponse::success(
                null,
                'Tarea eliminada correctamente',
                JsonResponse::HTTP_NO_CONTENT
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al eliminar la tarea',
                $e,
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }
}
