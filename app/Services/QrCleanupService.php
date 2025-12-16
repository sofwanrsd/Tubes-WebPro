<?php

namespace App\Services;

use App\Models\Order;

class QrCleanupService
{
    public function cleanup(Order $order): void
    {
        if (!$order->payment) return;

        $order->payment->update([
            'qris_dynamic_payload' => null,
            'qris_dynamic_image' => null,
        ]);
    }
}
