<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MutasiService
{
    public function fetchLatest(): array
    {
        $res = Http::asForm()
            ->timeout(20)
            ->post(config('services.mutasi.url'), [
                'username' => config('services.mutasi.username'),
                'token' => config('services.mutasi.token'),
                'id' => config('services.mutasi.id'),
            ]);

        if (!$res->ok()) {
            throw new \RuntimeException("Mutasi API HTTP ".$res->status());
        }

        $json = $res->json();

        if (($json['status'] ?? null) !== 'success') {
            throw new \RuntimeException("Mutasi API status not success");
        }

        return $json['data'] ?? [];
    }
}
