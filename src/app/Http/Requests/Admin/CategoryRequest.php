<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
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
        if ($this->isMethod('PUT')) {
            $categoryId = $this->route('category');
            $uniqueRule = Rule::unique('categories', 'category_name')->ignore($categoryId);
        } else {
            $uniqueRule = Rule::unique('categories', 'category_name');
        }

        return [
            'category_name' => ['required', $uniqueRule, 'max:50'],
        ];
    }
}
