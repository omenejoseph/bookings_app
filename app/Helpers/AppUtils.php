<?php


namespace App\Helpers;


use App\Enums\StatusCodeEnum;


class AppUtils
{
    public function jsonResponse(int $code, string $message = '', $data = [])
    {
        $ok_status = [StatusCodeEnum::OK, StatusCodeEnum::CREATED, StatusCodeEnum::UPDATED];
        $status = (in_array($code, $ok_status)) ? 'true' : 'false';
        return response()->json(['status' => $status, 'data' => $data, 'message' => $message], $code);
    }
}