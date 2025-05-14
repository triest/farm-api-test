<?php

namespace App\Http\Resources\Animal\AnimalObject;

use App\Http\Resources\Animal\AnimalOwner\AnimalOwnerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalObjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'owner' => $this->owner ? AnimalOwnerResource::make( $this->owner) : null
        ];
    }
}
