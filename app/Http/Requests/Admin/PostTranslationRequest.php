<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostTranslationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Changez ceci si vous avez des règles d'autorisation spécifiques
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'locale' => 'required|string|in:fr,en|max:5',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('post_translations')->ignore($this->translation)],
        ];
    }

    public function messages()
    {
        return [
            'locale.required' => 'La langue est obligatoire.',
            'locale.string' => 'La langue doit être une chaîne de caractères.',
            'locale.in' => 'La langue doit être soit "fr" soit "en".',
            'locale.max' => 'La langue ne doit pas dépasser 5 caractères.',
            'title.required' => 'Le champ titre est obligatoire.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'content.required' => 'Le champ contenu est obligatoire.',
            'content.string' => 'Le contenu doit être une chaîne de caractères.',
            'excerpt.string' => 'L\'extrait doit être une chaîne de caractères.',
            'excerpt.max' => 'L\'extrait ne doit pas dépasser 255 caractères.',
            'slug.required' => 'Le champ slug est obligatoire.',
            'slug.string' => 'Le slug doit être une chaîne de caractères.',
            'slug.max' => 'Le slug ne doit pas dépasser 255 caractères.',
            'slug.unique' => 'Le slug est déjà pris.',
        ];
    }
}
