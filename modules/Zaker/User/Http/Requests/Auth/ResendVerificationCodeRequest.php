<?php

namespace Zaker\User\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Zaker\User\Http\Controllers\Auth\GetRegisteFieldAndValueTrait;
use Zaker\User\Rules\ValidMobile;

class ResendVerificationCodeRequest extends FormRequest
{
    use GetRegisteFieldAndValueTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mobile' => ['required_without:email', 'string','min:9','max:14',new ValidMobile()],
            'email' => 'required_without:mobile|email',
        ];
    }
}
