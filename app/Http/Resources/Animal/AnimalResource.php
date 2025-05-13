<?php

namespace App\Http\Resources\Animal;

use App\Http\Resources\Animal\AnimalOwner\AnimalObjectResource;
use App\Http\Resources\Animal\AnimalOwner\AnimalOwnerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'number' => $this->number,
                'object' => $this->animalObject ? AnimalObjectResource::make($this->animalObject) : null,
                'owner' => $this->animalOwner ? AnimalOwnerResource::make($this->animalOwner) : null,
                'color' => $this->animalColor,
                'gender' => $this->animalGender,
                'species' => $this->animalSpecies,
            ];
    }
}
