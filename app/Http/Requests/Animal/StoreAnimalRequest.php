<?php

namespace App\Http\Requests\Animal;

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
            'number' => 'required|numeric|unique:animals,number',
            'gender_id' => 'required|exists:animal_genders,id',
            'animal_species_id' => 'required|exists:animal_species,id',
            'animal_color_id' => 'required|exists:animal_colors,id',
            'animal_object_id' => 'required|exists:animal_objects,id',
            'animal_owner_id' => 'required|exists:animal_owners,id',
        ];
    }
}
