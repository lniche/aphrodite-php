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
    public function respond(mixed $data = [], string $message = 'ok', int $code = 0): JsonResponse
    {
        $parameters = [
            'code' => $code,
            'message' => $message,
        ];

        if ($data !== null) {
            $parameters['data'] = $data;
        }

        return response()->json($parameters, $code);
    }

    /**
     * Send a Failure JSON Response.
     */
    public function fail(string $message = 'err', int $code = -1, mixed $data = []): JsonResponse
    {
        $parameters = [
            'code' => $code,
            'message' => $message,
        ];

        if ($data !== null) {
            $parameters['data'] = $data;
        }

        throw new HttpResponseException(response()->json($parameters, $code));
    }
}
