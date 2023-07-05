<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'meter_id',
        'units',
        'status',
    ];

    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }
}
