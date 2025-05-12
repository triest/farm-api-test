<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimalRequest extends FormRequest
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
        return [
            'name' => 'required',
            'number' => 'required|numeric|unique:animals,number',
            'gender_id' => 'required|exists:genders,id',
            'animal_species_id' => 'required|exists:animal_species,id',
            'animal_color_id' => 'required|exists:animal_colors,id',
        ];
    }
}
