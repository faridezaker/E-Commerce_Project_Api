<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use PHPUnit\TextUI\Output\Default\UnexpectedOutputPrinter;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //TODO:check
        return true;
        //return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:190|regex:/^[a-zA-Z\s\-]+$/u',
            'slug' => 'required|string|max:190|regex:/^[a-zA-Z\-]+$/u',
            'parent_id' => 'nullable|numeric|exists:categories,id',
        ];
    }
}
