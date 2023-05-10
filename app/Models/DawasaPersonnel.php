<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class DawasaPersonnel extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'user_id',
        'office_id',
        'role',
    ];

    public function personnel()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function office()
    {
        return $this->belongsTo(DawasaOffice::class, 'office_id', 'id');
    }
}
