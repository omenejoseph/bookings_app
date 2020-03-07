<?php

namespace App\Exceptions;

use App\Enums\StatusCodeEnum;
use App\Facade\AppUtils;
use Exception;

class BadRequestException extends Exception
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
        return AppUtils::jsonResponse(StatusCodeEnum::BAD_REQUEST, $this->message);
    }
}
