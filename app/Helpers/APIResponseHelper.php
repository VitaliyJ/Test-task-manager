<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class APIResponseHelper
{
    public static function getFailedResponse(string|array $errors, int $status): JsonResponse
    {
        if (is_string($errors)) {
            $errors = [$errors];
        }

        return response()->json(['errors' => $errors], $status);
    }

    public static function getSuccessResponse(Collection|Model $data, int $status = 200): JsonResponse
    {
        return response()->json(['data' => $data], $status);
    }
}
