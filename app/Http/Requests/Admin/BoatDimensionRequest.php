<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BoatDimensionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'weight_range' => 'required|string|max:255',
            'mold_number' => 'required|integer|min:0',
            'length_cm' => 'required|integer|min:0',
            'shape' => 'required|string|max:255',
            'boat_type' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'weight_range.required' => 'La plage de poids est obligatoire.',
            'weight_range.string' => 'La plage de poids doit être une chaîne de caractères.',
            'weight_range.max' => 'La plage de poids ne doit pas dépasser 255 caractères.',

            'mold_number.required' => 'Le numéro de moule est obligatoire.',
            'mold_number.integer' => 'Le numéro de moule doit être un nombre entier.',
            'mold_number.min' => 'Le numéro de moule doit être au moins 0.',

            'length_cm.required' => 'La longueur est obligatoire.',
            'length_cm.integer' => 'La longueur doit être un nombre entier.',
            'length_cm.min' => 'La longueur doit être au moins 0.',

            'shape.required' => 'La forme est obligatoire.',
            'shape.string' => 'La forme doit être une chaîne de caractères.',
            'shape.max' => 'La forme ne doit pas dépasser 255 caractères.',

            'boat_type.required' => 'Le type de bateau est obligatoire.',
            'boat_type.string' => 'Le type de bateau doit être une chaîne de caractères.',
            'boat_type.max' => 'Le type de bateau ne doit pas dépasser 255 caractères.',
        ];
    }
}
