<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    public function animalSpecies(): BelongsTo
    {
        return $this->belongsTo(AnimalSpecies::class);
    }

    public function animalColor(): BelongsTo
    {
        return $this->belongsTo(AnimalColor::class);
    }

    public function animalObject(): BelongsTo
    {
        return $this->belongsTo(AnimalObject::class);
    }

    public function animalOwner(): BelongsTo
    {
        return $this->belongsTo(AnimalOwner::class);
    }

    public function animalGender()
    {
        return $this->belongsTo(AnimalGender::class);
    }

}
