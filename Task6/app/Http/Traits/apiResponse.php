<?php

namespace App\Http\Traits;

trait apiResponse
{

    function responseJson($status, $message, $data = null)
    {
        $response = [
            'Status' => $status,
            'message' => $message,
            'data' => (object)$data
        ];

        return response()->json($response);
    }
}
