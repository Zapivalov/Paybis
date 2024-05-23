<?php

declare(strict_types=1);

namespace App\Dto\Factory;

use App\Entity\CryptoRate;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CryptoRateResponseFactory
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function create(array $cryptoRatesResponse): void
    {
        foreach ($cryptoRatesResponse as $cryptoRateResponse) {
            $cryptoRate = new CryptoRate(
                $cryptoRateResponse->getCoin(),
                $cryptoRateResponse->getCurrency(),
                $cryptoRateResponse->getRate(),
                $cryptoRateResponse->getDateTime(),
            );

            $this->entityManager->persist($cryptoRate);
        }
        $this->entityManager->flush();
    }
}
