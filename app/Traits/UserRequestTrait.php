<?php

namespace App\Traits;

use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use App\Enums\TitleEnum;
use OmeneJoseph\EnumManager\Facades\EnumManager;


/**
 * [trait description]
 */
trait UserRequestTrait
{
    use RequestTrait;

    private function valArray(){
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|in:'.EnumManager::enumValues(GenderEnum::class),
            'title' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'username' => 'required|string|unique:users',
            'role' => 'required|string|in:'.EnumManager::enumValues(RoleEnum::class),
            'password' => 'required|confirmed|string'
        ];
    }



}