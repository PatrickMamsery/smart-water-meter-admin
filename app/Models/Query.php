<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class Query extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $fillable = [
        'customer_id',
        'query_date',
        'query_action',
        'description',
        'query_status',
    ];

    protected $allowedSorts = [
        'query_date',
        'query_action',
        'query_status',
    ];

    protected $allowedFilters = [
        'query_date',
        'query_action',
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
