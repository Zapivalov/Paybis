<?php

declare(strict_types=1);

namespace App\Command;

use App\Dto\Factory\CryptoRateResponseFactory;
use App\Request\CoingeckoQueryApiClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(name: 'app:coin:rates:update')]
final class CoinRatesUpdateCommand extends Command
{
    public function __construct(
        private readonly CoingeckoQueryApiClient $apiClient,
        private readonly CryptoRateResponseFactory $cryptoRateResponseFactory,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $cryptoRatesResponse = $this->apiClient->fetchRates();
            $this->cryptoRateResponseFactory->create($cryptoRatesResponse);
        } catch (Throwable $e) {
            $output->writeln(sprintf('Error: %s', $e->getMessage()));

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
