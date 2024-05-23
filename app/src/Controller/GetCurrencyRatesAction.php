<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\GetRatesRequest;
use App\Repository\CryptoRateRepository;
use App\Transformer\CryptoRateTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

#[Route(
    '/api/rates',
    name: 'api.rates',
    methods: [Request::METHOD_GET],
)]
final class GetCurrencyRatesAction extends AbstractController
{
    public function __construct(
        private readonly CryptoRateRepository $repository,
        private readonly CryptoRateTransformer $transformer,
        private readonly ValidatorInterface $validator,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $getRatesRequest = new GetRatesRequest(
                $request->query->get('currency'),
                $request->query->get('start_date'),
                $request->query->get('end_date'),
            );

            $errors = $this->validator->validate($getRatesRequest);
            if (count($errors) > 0) {
                throw new BadRequestHttpException((string) $errors);
            }

            $cryptoRates = $this->repository->getRates(
                $getRatesRequest->getCurrency(),
                $getRatesRequest->getStartDate(),
                $getRatesRequest->getEndDate(),
            );

            return $this->json($this->transformer->transformCollection($cryptoRates));
        } catch (Throwable $e) {

            return new JsonResponse(
                sprintf('Error: %s', $e->getMessage()),
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
