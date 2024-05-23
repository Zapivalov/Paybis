<?php

declare(strict_types=1);

namespace App\Dto;

use App\Validator\ValidCurrency;
use DateTimeImmutable;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class GetRatesRequest
{
    private const DEFAULT_CURRENCY = 'usd';

    public function __construct(
        #[ValidCurrency]
        private ?string $currency,

        #[SerializedName('start_date')]
        #[Assert\DateTime(format: DATE_ATOM, message: 'Invalid start_date format')]
        private ?string $startDate,

        #[SerializedName('end_date')]
        #[Assert\DateTime(format: DATE_ATOM, message: 'Invalid end_date format')]
        private ?string $endDate,
    ) {
    }

    public function getCurrency(): string
    {
        return $this->currency ?? self::DEFAULT_CURRENCY;
    }

    public function getStartDate(): ?DateTimeImmutable
    {
        return $this->startDate !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $this->startDate) : null;
    }

    public function getEndDate(): ?DateTimeImmutable
    {
        return $this->endDate !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $this->endDate) : null;
    }
}
