<?php

declare(strict_types=1);

namespace App\Dto\Factory;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CurrencyResponseFactory
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private CurrencyRepository $currencyRepository,
    ) {
    }

    public function create(array $currenciesResponse): void
    {
        $existingTickers = $this->currencyRepository->findAllTickers();

        foreach ($currenciesResponse as $currencyResponse) {
            $ticker = $currencyResponse->getTicker();

            if (!in_array($ticker, $existingTickers)) {
                $this->entityManager->persist(new Currency($ticker));
            }
        }
        $this->entityManager->flush();
    }
}
