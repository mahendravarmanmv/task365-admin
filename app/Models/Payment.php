<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'amount',
        'payment_id',
        'order_id',
        'status',
        'other',
        'lead_id', // Make sure this is fillable if you're creating/updating payments with lead info
    ];

    /**
     * Get the lead associated with the payment.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
}

