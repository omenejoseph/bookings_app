<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    protected $message;
    protected $status_code;
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
        $this->status_code = ($code == 0) ? 404 : $code;
    }

    public function render()
    {
        return response()->json(["status" => false, "message" => $this->message], $this->status_code);
    }
}
