<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalRequest extends FormRequest
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
            'number' => 'numeric',
            'gender_id' => 'exists:animal_genders,id',
            'animal_species_id' => 'exists:animal_species,id',
            'animal_color_id' => 'exists:animal_colors,id',
            'animal_object_id' => 'exists:animal_objects,id',
            'animal_owner_id' => 'exists:animal_owners,id',
        ];
    }
}
