<?php

namespace App\Traits;

trait ApiResponser
{
    private $response = ['message' => '', 'data' => '', 'success' => ''];

    public function generalisedResponse($message, $status, $data, $status_code)
    {
        $this->response['message'] = $message;
        $this->response['success'] = $status;
        $this->response['data'] = $data;
        return response()->json($this->response, $status_code);
    }

    public function successResponse($data, $status_code)
    {
        $response['success'] = true;
        $response['data'] = $data;
        return response()->json($response, $status_code);
    }

    public function makeExceptionResponse($message, $code, $object = '')
    {
        return response()->json([
            'message' => $message,
            'success' => false,
            'data' => $object
        ], $code);
    }
}
