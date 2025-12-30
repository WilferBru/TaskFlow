<?php

namespace App\Http\Controllers;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\GetUserAction;
use App\Actions\User\ShowUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdatePswdAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\UpdateUserRoleAction;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\UpdateUserRoleRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Resources\AdminResource;
use App\Http\Responses\apiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(GetUserAction $getUser)
    {
        try {
            $user = $getUser->execute();

            return apiResponse::success(
                AdminResource::collection($user),
                'Usuarios Obtenedios correctamente',
                JsonResponse::HTTP_OK // 200
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al obtener los usuarios.',
                $e,
                JsonResponse::HTTP_BAD_REQUEST // 400
            );
        }
    }

    public function store(CreateUserRequest $request, StoreUserAction $storeUser)
    {
        try {
            $user = $storeUser->execute($request->validated());

            return apiResponse::success(
                new AdminResource($user),
                'Usuario guardado correctamente',
                JsonResponse::HTTP_CREATED // 201
            );
        } catch (\Throwable $e) {
            return ApiResponse::error(
                'Error al guardar los usuarios.',
                $e,
                JsonResponse::HTTP_BAD_REQUEST // 400
            );
        }
    }

    public function show(ShowUserAction $showUser, User $user)
    {
        try {
            $userData = $showUser->execute($user);

            return apiResponse::success(
                new AdminResource($userData),
                'Usuario obtenido correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al obtener el usuario',
                $e,
                JsonResponse::HTTP_BAD_REQUEST // 400
            );
        }
    }

    public function update(UpdateUserRequest $request, User $user, UpdateUserAction $updateUser)
    {
        try {

            $userData = $updateUser->execute($request->validated(), $user);

            return apiResponse::success(
                new AdminResource($userData),
                'Usuario Actualizado correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al actualizar el usuario',
                $e,
                JsonResponse::HTTP_BAD_REQUEST // 400
            );
        }
    }

    public function changeRol(UpdateUserRoleRequest $request, User $user, UpdateUserRoleAction $updateRol)
    {
        try {

            $this->authorize('changeRol', User::class);

            $userData = $updateRol->execute($request->validated(), $user);

            return apiResponse::success(
                new AdminResource($userData),
                'Rol Actualizado correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al actualizar el rol del usuario',
                $e,
                JsonResponse::HTTP_BAD_REQUEST // 400
            );
        }
    }

    public function changePassword(ChangePasswordRequest $request, UpdatePswdAction $updatePassword)
    {
        try {

            //** @var \App\Models\User $user */
            $user = Auth::user();

            $changePassword = $updatePassword->execute($request->validated(), $user);

            return apiResponse::success(
                new AdminResource(($changePassword)),
                'Contraseña actualizada correctamente',
                JsonResponse::HTTP_OK
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al actualizar la contraseña del usuario',
                $e,
                JsonResponse::HTTP_BAD_REQUEST // 400
            );
        }
    }

    public function destroy(User $user, DeleteUserAction $userDel)
    {
        try {

            $userDel->execute($user);

            return apiResponse::success(
                null,
                'Usuario eliminado correctamente',
                JsonResponse::HTTP_NO_CONTENT
            );
        } catch (\Throwable $e) {
            return apiResponse::error(
                'Error al eliminar el usuario',
                $e,
                JsonResponse::HTTP_BAD_REQUEST // 400
            );
        }
    }
}
