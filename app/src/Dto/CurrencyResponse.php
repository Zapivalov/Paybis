<?php

declare(strict_types=1);

namespace App\Dto;

final readonly class CurrencyResponse
{
    public function __construct(
        private string $ticker,
    ) {
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }
}
