<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TransferStatus extends Model
{
    use HasFactory;

    public const STATUS_NEW = 'new';
    public const STATUS_IN_WORK = 'in_work';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';
    protected $hidden = ['created_at', 'updated_at'];

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'new',
            self::STATUS_IN_WORK => 'in_work',
            self::STATUS_COMPLETED => 'completed',
            self::STATUS_CANCELLED => 'cancelled',
        ];
    }

    protected static function boot() {
        parent::boot();
    }

}
