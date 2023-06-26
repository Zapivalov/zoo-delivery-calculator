<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Weight;

final class TransCompanyCalculator implements CalculatorInterface
{
    private const MIN_DELIVERY_COST = 20;
    private const MAX_DELIVERY_COST = 100;
    private const MIN_DELIVERY_MAX_WEIGHT = 10;

    public function calculate(Weight $weight): int
    {
        return $weight->value <= self::MIN_DELIVERY_MAX_WEIGHT
            ? self::MIN_DELIVERY_COST
            : self::MAX_DELIVERY_COST;
    }
}
