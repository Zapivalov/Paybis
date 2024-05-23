<?php

declare(strict_types=1);

namespace App\Dto;

use DateTimeInterface;

final readonly class CryptoRateResponse
{
    public function __construct(
        private string $coin,
        private string $currency,
        private float $rate,
        private DateTimeInterface $dateTime,
    ) {
    }

    public function getCoin(): string
    {
        return $this->coin;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }
}
