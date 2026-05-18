<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'price',
        'category',
        'rating',
        'reviews',
        'description',
        'image',
        'ingredients',
        'storage',
        'artisan_note',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'reviews' => 'integer',
    ];
}
