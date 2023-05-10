<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class CustomerPayment extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'customer_id',
        'payment_id',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
