<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryTranslationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'locale' => 'required|string|in:fr,en|max:2',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:category_translations,slug,' . $this->route('category_translation'),
        ];
    }

    public function messages()
    {
        return [
            'locale.required' => 'La langue est obligatoire.',
            'locale.in' => 'La langue doit être soit "fr" soit "en".',
            'name.required' => 'Le nom est obligatoire.',
            'slug.required' => 'Le slug est obligatoire.',
            'slug.unique' => 'Ce slug est déjà pris.',
        ];
    }
}
