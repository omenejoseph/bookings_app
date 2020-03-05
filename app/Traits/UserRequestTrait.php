<?php

namespace App\Traits;

use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use App\Enums\TitleEnum;
use OmeneJoseph\EnumManager\Facades\EnumManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * [trait description]
 */
trait UserRequestTrait
{
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

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['status'=> false, 'errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

}