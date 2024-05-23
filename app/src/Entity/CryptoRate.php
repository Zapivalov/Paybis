<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CryptoRateRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Index(name: 'currency_date_time_idx', columns: ['currency', 'date_time'])]
#[ORM\Entity(repositoryClass: CryptoRateRepository::class)]
class CryptoRate
{
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;

    #[ORM\Column(name: 'coin', type: 'string', nullable: false)]
    private string $coin;

    #[ORM\Column(name: 'currency', type: 'string', nullable: false)]
    private string $currency;

    #[ORM\Column(name: 'rate', type: 'float', nullable: false)]
    private float $rate;

    #[ORM\Column(name: 'date_time', type: 'datetime_immutable', nullable: false)]
    private DateTimeInterface $dateTime;

    public function __construct(
        string $coin,
        string $currency,
        float $rate,
        DateTimeInterface $dateTime,
    ) {
        $this->coin = $coin;
        $this->currency = $currency;
        $this->rate = $rate;
        $this->dateTime = $dateTime;
    }

    public function getId(): int
    {
        return $this->id;
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
