<?php

declare(strict_types=1);

namespace App\Request;

use App\Dto\CryptoRateResponse;
use App\Dto\CurrencyResponse;
use App\Repository\CurrencyRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use RuntimeException;
use Throwable;

final readonly class CoingeckoQueryApiClient
{
    private const BASE_API_URL = 'https://api.coingecko.com/api/v3';

    public function __construct(
        private HttpClientInterface $client,
        private CurrencyRepository $currencyRepository,
    ) {
    }

    public function fetchRates(): array
    {
        try {
            $response = $this->client->request(Request::METHOD_GET, self::BASE_API_URL . '/simple/price', [
                'query' => [
                    'precision' => 'full',
                    'ids' => 'bitcoin',
                    'vs_currencies' => implode(',', $this->currencyRepository->findAllTickers()),
                ],
            ]);

            $data = $response->toArray();

            $rates = [];
            foreach ($data['bitcoin'] as $currency => $rate) {
                $rates[] = new CryptoRateResponse(
                    'bitcoin',
                    $currency,
                    $rate,
                    new DateTimeImmutable(),
                );
            }

            return $rates;
        } catch (Throwable $e) {
            throw new RuntimeException('Failed to fetch rates from Coingecko API: ' . $e->getMessage());
        }
    }

    public function getCurrencyTickers(): array
    {
        try {
            $response = $this->client->request(Request::METHOD_GET, self::BASE_API_URL . '/simple/supported_vs_currencies');

            return array_map(fn($ticker) => new CurrencyResponse($ticker), $response->toArray());
        } catch (Throwable $e) {
            throw new RuntimeException('Failed to fetch supported currencies from Coingecko API: ' . $e->getMessage());
        }
    }
}
