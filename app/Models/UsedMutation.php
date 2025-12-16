<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsedMutation extends Model
{
    protected $fillable = [
        'order_id',
        'mutation_key',
        'mutation_id',
        'amount',
        'mutation_time',
        'description',
        'raw',
    ];

    protected $casts = [
        'mutation_time' => 'datetime',
        'raw' => 'array',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
