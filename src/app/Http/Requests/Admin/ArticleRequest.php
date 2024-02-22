<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleRequest extends FormRequest
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
            $articleId = $this->route('article');
            $uniqueRule = Rule::unique('articles', 'article_title')->ignore($articleId);
        } else {
            $uniqueRule = Rule::unique('articles', 'article_title');
        }

        return [
            'article_title' => ['required', $uniqueRule, 'max:255'],
            'category_id' => 'required',
        ];
    }
}
