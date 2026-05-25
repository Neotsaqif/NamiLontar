<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['code', 'type', 'amount', 'status', 'start_date', 'end_date'];

    /**
     * Boot function to automatically format the discount code to uppercase on save.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($discount) {
            $discount->code = strtoupper($discount->code);
        });
    }
}
