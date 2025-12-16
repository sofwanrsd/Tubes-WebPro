<?php

namespace App\Services;

use App\Models\Order;

class UniqueAmountService
{
    public function generateUniqueCode(int $subtotal): int
    {
        $min = (int) env('UNIQUE_CODE_MIN', 1);
        $max = (int) env('UNIQUE_CODE_MAX', 999);

        $activeTotals = Order::query()
            ->where('status', 'pending')
            ->whereNotNull('expires_at')
            ->where('expires_at', '>', now())
            ->pluck('total_amount')
            ->all();

        $activeTotals = array_flip($activeTotals);

        for ($i = 0; $i < 2000; $i++) {
            $code = random_int($min, $max);
            $total = $subtotal + $code;

            if (!isset($activeTotals[$total])) {
                return $code;
            }
        }

        // fallback (rare)
        return random_int($min, $max);
    }
}
