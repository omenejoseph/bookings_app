<?php

namespace App\Enums;
use OmeneJoseph\EnumManager\EnumManager;


class StatusCodeEnum extends EnumManager
{
   const OK = 200;
   const CREATED = 201;
   const UPDATED = 202;
   const NOT_FOUND = 404;
   const BAD_REQUEST = 400;
   const SERVER_ERROR = 500;

}