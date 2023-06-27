<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;

class Meter extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $fillable = [
        'customer_id',
        'meter_number',
        'meter_type',
        'meter_status',
        'meter_location',
    ];

    protected $allowedFilters = [
        'meter_number' => Like::class,
        'meter_type' => Where::class,
        'meter_status' => Where::class,
        'meter_location' => Like::class,
    ];

    protected $allowedSorts = [
        'meter_number',
        'meter_type',
        'meter_status',
        'meter_location',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function readings()
    {
        return $this->hasMany(MeterReading::class);
    }
}
