<?php

namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalObject extends Model
{
    use HasFactory;

    public function animal()
    {
        return $this->hasMany(Animal::class);
    }

    public function owner()
    {
        return $this->belongsTo(AnimalOwner::class);
    }
}
