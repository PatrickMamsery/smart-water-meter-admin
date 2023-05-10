<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Meter extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'customer_id',
        'meter_number',
        'meter_type',
        'meter_status',
        'meter_location',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}
