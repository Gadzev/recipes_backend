<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Constants\ResponseType;
use Illuminate\Http\JsonResponse;
use App\Libraries\Utility;
use App\Http\Controllers\Controller;

class V1Controller extends Controller
{
    public $version = 'v1';

    public function respond(Array $data = null, Array $errors = [],
        String $message = null, int $statusCode = ResponseType::OK,
        Array $headers = []) : JsonResponse
    {
        return Utility::generateResponse($data, $errors, $message, $this->version, $statusCode, $headers);
    }
}