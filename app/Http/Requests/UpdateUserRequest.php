<?php

namespace App\Http\Requests;

use App\Traits\UserRequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateUserRequest extends FormRequest
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
        return Arr::except($this->valArray(), ['email', 'password', 'username']);
    }
}
