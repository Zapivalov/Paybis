<?php

declare(strict_types=1);

namespace App\Transformer;

use App\Entity\CryptoRate;

final class CryptoRateTransformer
{
    public function transform(CryptoRate $cryptoRate): array
    {
        return [
            'date_time' => $cryptoRate->getDateTime()->format(DATE_ATOM),
            'rate' => $cryptoRate->getRate(),
        ];
    }

    public function transformCollection(array $cryptoRates): array
    {
        return array_map([$this, 'transform'], $cryptoRates);
    }
}
