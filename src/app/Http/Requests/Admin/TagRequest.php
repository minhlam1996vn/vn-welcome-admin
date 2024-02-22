<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
            $tagId = $this->route('tag');
            $uniqueRule = Rule::unique('tags', 'tag_name')->ignore($tagId);
        } else {
            $uniqueRule = Rule::unique('tags', 'tag_name');
        }

        return [
            'tag_name' => ['required', $uniqueRule, 'max:50'],
        ];
    }
}
