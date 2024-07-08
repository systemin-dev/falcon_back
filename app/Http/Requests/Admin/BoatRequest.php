<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Boat;

class BoatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'category' => ['required', 'string', 'max:255', Rule::in(array_keys(Boat::CATEGORIES))],
            'condition' => ['required', 'string', Rule::in(array_keys(Boat::CONDITIONS))],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,bmp,webp', 'max:5120', Rule::requiredIf(!$this?->boat?->id)],
        ];

        foreach ($this->input('translations', []) as $locale => $translation) {
            $rules["translations.$locale.description"] = ['required', 'string'];
            $rules["translations.$locale.base"] = ['required', 'string', 'max:255'];
            $rules["translations.$locale.construction_type"] = ['required', 'string', 'max:255'];
            $rules["translations.$locale.flat_board"] = ['required', 'string', 'max:255'];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'category.required' => 'La catégorie est obligatoire.',
            'category.string' => 'La catégorie doit être une chaîne de caractères.',
            'category.max' => 'La catégorie ne doit pas dépasser 255 caractères.',
            'category.in' => 'La catégorie doit être l\'une des valeurs suivantes : ' . implode(', ', array_keys(Boat::CATEGORIES)) . '.',

            'condition.required' => 'L\'état est obligatoire.',
            'condition.string' => 'L\'état doit être une chaîne de caractères.',
            'condition.in' => 'L\'état doit être l\'une des valeurs suivantes : ' . implode(', ', Boat::CONDITIONS) . '.',

            'image.required' => 'L\'image est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être un fichier de type : jpeg, png, jpg, gif, bmp, webp.',
            'image.max' => 'L\'image ne doit pas dépasser 5120 kilobytes.',
        ];

        foreach ($this->input('translations', []) as $locale => $translation) {
            $messages["translations.$locale.description.required"] = 'Le champ description ' . $locale . ' est obligatoire.';
            $messages["translations.$locale.description.string"] = 'La description ' . $locale . ' doit être une chaîne de caractères.';
            $messages["translations.$locale.base.required"] = 'Le champ base ' . $locale . ' est obligatoire.';
            $messages["translations.$locale.base.string"] = 'La base ' . $locale . ' doit être une chaîne de caractères.';
            $messages["translations.$locale.base.max"] = 'La base ' . $locale . ' ne doit pas dépasser 255 caractères.';
            $messages["translations.$locale.construction_type.required"] = 'Le champ type de construction ' . $locale . ' est obligatoire.';
            $messages["translations.$locale.construction_type.string"] = 'Le type de construction ' . $locale . ' doit être une chaîne de caractères.';
            $messages["translations.$locale.construction_type.max"] = 'Le type de construction ' . $locale . ' ne doit pas dépasser 255 caractères.';
            $messages["translations.$locale.flat_board.required"] = 'Le champ plat bord ' . $locale . ' est obligatoire.';
            $messages["translations.$locale.flat_board.string"] = 'Le plat bord ' . $locale . ' doit être une chaîne de caractères.';
            $messages["translations.$locale.flat_board.max"] = 'Le plat bord ' . $locale . ' ne doit pas dépasser 255 caractères.';
        }

        return $messages;
    }
}
