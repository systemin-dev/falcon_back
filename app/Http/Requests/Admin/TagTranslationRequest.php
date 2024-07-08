<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TagTranslationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'locale' => 'required|string|max:5',
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'locale.required' => 'La langue est obligatoire.',
            'locale.string' => 'La langue doit être une chaîne de caractères.',
            'locale.max' => 'La langue ne doit pas dépasser 5 caractères.',
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        ];
    }
}
