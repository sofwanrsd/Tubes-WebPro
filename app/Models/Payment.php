<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'method',
        'expected_amount',
        'qris_static_ref',
        'qris_dynamic_payload',
        'qris_dynamic_image',
        'qris_generated_at',
        'last_checked_at',
        'status',
    ];

    protected $casts = [
        'qris_generated_at' => 'datetime',
        'last_checked_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
