<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Weight;

final class PackGroupCalculator implements CalculatorInterface
{
    public function calculate(Weight $weight): int
    {
        return $weight->value;
    }
}
