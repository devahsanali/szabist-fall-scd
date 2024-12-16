<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponseHelper
{
    /**
     * Return a success response.
     *
     * @param string $message
     * @param mixed|null $data
     * @return JsonResponse
     */
    public static function success(string $message, mixed $data = null): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * Return an error response.
     *
     * @param string $message
     * @param mixed|null $data
     * @return JsonResponse
     */
    public static function error(string $message, mixed $data = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], 400);
    }
}
