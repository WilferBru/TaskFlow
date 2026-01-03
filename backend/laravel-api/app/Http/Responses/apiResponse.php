<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class apiResponse
{
    public static function success($data = null, string $message = 'Operacion exitosa', int $status = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function error(string $message = '', $e = null, int $status = JsonResponse::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        $errorData = null;

        if ($e instanceof \Throwable) {
            $errorData = [
                'type' => get_class($e),
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ];
        } else {
            $errorData = $e; // por si envías un mensaje o arreglo directamente
        }

        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $errorData,
        ], $status);
    }
}
