<?php

namespace Zaker\User\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Zaker\User\Rules\ValidPassword;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (auth()->check())
            return true;

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', new ValidPassword()],
        ];
    }
}
