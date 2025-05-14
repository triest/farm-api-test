<?php

namespace App\Models;

use App\Models\Animal\Animal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransferDocument extends Model
{
    use HasFactory, softDeletes;

    public function dispatchObject()
    {
        return $this->morphTo('dispatchObject');
    }

    public function destinationObject()
    {
        return $this->morphTo('destinationObject');
    }

    public function transferObject()
    {
        return $this->morphTo('transferObject');
    }

    public function status(){
        return $this->belongsTo(TransferStatus::class);
    }


    public function changeOwner()
    {
        $animal = $this->transferObject;

        $distinctionObject = $this->dispatchObject;

        $animal->animalObject()->associate($distinctionObject);
        $newOwner = $distinctionObject->owner;

        if ($animal->animal_owner_id != $newOwner->id) {
            $animal->animalOwner()->associate($newOwner);
        }
        $animal->save();
    }
}
