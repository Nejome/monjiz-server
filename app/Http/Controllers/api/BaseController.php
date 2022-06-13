<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function success($message, $payload = [])
    {
        $response = [
            'status' => 1,
            'data'    => $payload,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function error($error, $code = 404)
    {
        $response = [
            'status' => 0,
            'message' => $error,
        ];

        return response()->json($response, $code);
    }
}
