<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
final class ValidCurrency extends Constraint
{
    public string $message = 'The currency "{{ value }}" is not valid.';
}
