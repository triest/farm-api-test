<?php

namespace App\Http\Resources\Animal\AnimalTransfer;

use App\Http\Resources\Animal\AnimalOwner\AnimalObjectResource;
use App\Http\Resources\Animal\AnimalResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalTransferResource extends JsonResource
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
            'date' => $this->date,
            'status' => $this->status ? AnimalTransferStatusResource::make($this->status) : null,
            'animal' => $this->transferObject ? AnimalResource::make($this->transferObject) : null,
            'destination' => $this->destinationObject ? AnimalObjectResource::make($this->destinationObject) : null,
            'dispatch' => $this->dispatchObject ? AnimalObjectResource::make($this->dispatchObject) : null,
        ];
    }
}
