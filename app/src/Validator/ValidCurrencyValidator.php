<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\CurrencyRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class ValidCurrencyValidator extends ConstraintValidator
{
    public function __construct(
        private readonly CurrencyRepository $currencyRepository
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $validCurrencies = $this->currencyRepository->findAllTickers();

        if (!in_array($value, $validCurrencies, true)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
