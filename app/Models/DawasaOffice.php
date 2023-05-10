<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class DawasaOffice extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
        'location',
    ];

    public function personnels()
    {
        return $this->hasMany(DawasaPersonnel::class);
    }
}
