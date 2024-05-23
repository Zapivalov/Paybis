<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CryptoRate;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CryptoRateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CryptoRate::class);
    }

    public function getRates(string $currency, ?DateTimeImmutable $startDate, ?DateTimeImmutable $endDate): array
    {
        $qb = $this->createQueryBuilder('r')
            ->where('r.currency = :currency')
            ->orderBy('r.dateTime', 'ASC')
            ->setParameter('currency', $currency);

        if ($startDate !== null) {
            $qb
                ->andWhere('r.dateTime >= :startDate')
                ->setParameter('startDate', $startDate->format(DATE_ATOM));
        }

        if ($endDate !== null) {
            $qb
                ->andWhere('r.dateTime <= :endDate')
                ->setParameter('endDate', $endDate->format(DATE_ATOM));
        }

        return $qb->getQuery()->getResult();
    }
}
