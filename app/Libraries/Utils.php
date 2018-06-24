<?php

namespace App\Libraries;

use App\Constants\ResponseType;
use Illuminate\Http\JsonResponse;


class Utility
{
    public static function generateResponse(Array $data = null, Array $errors = [],
                            String $message = null, String $version = 'v1',
                            int $statusCode = ResponseType::OK, Array $headers = []) : JsonResponse
    {
        $response = [
            'errors' => $errors,
            'data' => $data,
            'message' => $message,
            'version' => $version
        ];

        return response()->json($response, $statusCode, $headers);
    }
}