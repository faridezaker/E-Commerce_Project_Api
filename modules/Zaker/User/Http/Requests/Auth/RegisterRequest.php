<?php

namespace Zaker\User\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Zaker\User\Http\Controllers\Auth\GetRegisteFieldAndValueTrait;
use Zaker\User\Models\User;
use Zaker\User\Rules\ValidMobile;
use Zaker\User\Rules\ValidPassword;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255','regex:/^[a-zA-Z\s]*$/'],
            'mobile' => ['required_without:email', 'string','min:9','max:14',new ValidMobile()],
            'email' => 'required_without:mobile|email',
           // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
           // 'mobile' => ['required_without:email', 'string','min:9','max:14',new ValidMobile()],
            'password' => ['required', 'confirmed', new ValidPassword()],
        ];
    }
}
