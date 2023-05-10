<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class MeterReading extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'customer_id',
        'meter_id',
        'meter_reading',
        'meter_reading_date',
        'meter_reading_status',
        'meter_reading_image',
        'meter_reading_comment',
    ];

    protected $dates = [
        'meter_reading_date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function meter()
    {
        return $this->belongsTo(Meter::class, 'meter_id', 'id');
    }
}
