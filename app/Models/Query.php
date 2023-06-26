<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Query extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'customer_id',
        'query_date',
        'query_action',
        'description',
        'query_status',
    ];

    protected $dates = [
        'query_date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}
