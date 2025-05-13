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
        return $this->morphTo('dispatch_object');
    }

    public function destinationObject()
    {
        return $this->morphTo('destination_object');
    }

    public function transferObject()
    {
        return $this->morphTo('transfer_object');
    }

    public function status(){
        return $this->belongsTo(TransferStatus::class);
    }
}
