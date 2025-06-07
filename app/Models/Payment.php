<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'amount', 'payment_id', 'order_id', 'status', 'other'
    ];
}

