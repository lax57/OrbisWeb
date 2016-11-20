<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

class ApiController extends Controller {

    protected $statusCode;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondNotFound($message);
    }

    public function respondAuthenticationFailed($message)
    {
        return $this->setStatusCode(401)->repondWithError($message);
    }

    public function respond($data, $headers = [])
    {
        $this->setStatusCode(200);
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    public function repondWithError($message)
    {
        return response()->json([
            'error' => [
                'message' => $message,
                'status_code' => $this-> getStatusCode()
            ]
        ]);
    }
}
