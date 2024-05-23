<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
final class Currency
{
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;

    #[ORM\Column(name: 'ticker', type: 'string', unique: true, nullable: false)]
    private string $ticker;

    public function __construct(string $ticker)
    {
        $this->ticker = $ticker;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }
}
