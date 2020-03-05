<?php

namespace App\Http\Requests;

use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use App\Enums\TitleEnum;
use App\Traits\UserRequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use OmeneJoseph\EnumManager\Facades\EnumManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
{
    use UserRequestTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->valArray();
    }

}
