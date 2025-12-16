<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QrisDynamicService
{
    public function generate(string $qrisRaw, int $amount): array
    {
        $base = config('services.qris.base');
        $path = config('services.qris.path');

        $url = rtrim($base, '/') . $path;

        $res = Http::timeout(20)
            ->acceptJson()
            ->asJson()
            ->post($url, [
                'qris_raw' => $qrisRaw,
                'amount' => (string) $amount,
            ]);

        if (!$res->ok()) {
            throw new \RuntimeException("QRIS Dynamic API HTTP ".$res->status());
        }

        $json = $res->json();

        if (!($json['status'] ?? false)) {
            throw new \RuntimeException("QRIS Dynamic API response status false");
        }

        return [
            'qris_dynamic' => $json['qris_dynamic'] ?? null,
            'qr_png' => $json['qr_png'] ?? null,
        ];
    }
}
