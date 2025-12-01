<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CustomException extends Exception
{
    protected $statusCode;
    protected $data;

    public function __construct(
        string $message = "Something went wrong",
        array $data = [],
        int $statusCode = Response::HTTP_BAD_REQUEST
    ) {
        parent::__construct($message, $statusCode);
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
            'data' => $this->data,
            'code' => $this->statusCode,
        ], $this->statusCode);
    }
}
