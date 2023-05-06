<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class News extends Model
{
    use AsSource;

    protected $fillable=[
        'title',
        'image_path',
        'content',
    ];

}
