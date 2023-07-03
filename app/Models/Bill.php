<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Bill extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'title',
        'reference_number',
        'customer_id',
        'amount',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    // set status overdue if today's date is a week after the created date
    public function getStatusAttribute($value)
    {
        if ($value == 'unpaid') {
            if (now()->diffInDays($this->created_at) > 7) {
                return 'overdue';
            }
        }

        return $value;
    }
}
