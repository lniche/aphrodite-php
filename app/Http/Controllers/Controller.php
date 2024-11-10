<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Send a Success JSON Response.
     */
    public function respond(mixed $data = [], string $message = 'ok', int $code = 0, int $httpStatus = 200): JsonResponse
    {
        $parameters = [
            'code' => $code,
            'message' => $message,
        ];

        if ($data !== null) {
            $parameters['data'] = $data;
        }

        return response()->json($parameters, $httpStatus);
    }

    /**
     * Send a Failure JSON Response.
     */
    public function fail(string $message = 'err', int $code = -1, mixed $data = [], int $httpStatus = 500): JsonResponse
    {
        $parameters = [
            'code' => $code,
            'message' => $message,
        ];

        if ($data !== null) {
            $parameters['data'] = $data;
        }

        throw new HttpResponseException(response()->json($parameters, $httpStatus));
    }
}
