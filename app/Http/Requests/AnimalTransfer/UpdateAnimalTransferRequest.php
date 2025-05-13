<?php

namespace App\Http\Requests\AnimalTransfer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalTransferRequest extends FormRequest
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
            'dispatch_object_id' => 'integer|exists:animal_objects,id',
            'destination_object_id' => 'integer|exists:animal_objects,id',
            'status_id' => 'integer|exists:transfer_statuses,id',
        ];
    }
}
