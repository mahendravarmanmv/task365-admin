<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;
use App\Models\User;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'payment_id',
        'order_id',
        'status',
        'other',
        'lead_id',
    ];

    protected $casts = [
        'other' => 'array',
    ];

    /**
     * Get the lead associated with the payment.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }

    /**
     * Get the user who made the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get formatted payment meta data from the 'other' JSON.
     */
    public function getPaymentMetaAttribute()
{
    $json = $this->other; // Already an array due to $casts

    if (!is_array($json) || !isset($json['original']['data'][0])) {
        return [];
    }

    $data = $json['original']['data'][0];

    return [
        'name' => optional($this->user)->name ?? 'N/A',
        'phone' => $data['payment_method']['app']['phone'] ?? optional($this->user)->phone ?? 'N/A',
        'provider' => $data['payment_method']['app']['provider'] ?? 'N/A',
        'status' => $data['payment_status'] ?? 'N/A',
        'status_msg' => match ($data['payment_status']) {
            'SUCCESS' => 'Payment Success',
            'FAILED' => 'Failed: ' . ($data['error_details']['error_description_raw'] ?? 'Unknown Reason'),
            'PENDING' => 'Pending',
            'USER_DROPPED' => 'User Dropped',
            default => ucfirst(strtolower($data['payment_status'] ?? 'Unknown')),
        },
    ];
}

}
