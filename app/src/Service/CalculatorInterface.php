<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Weight;

interface CalculatorInterface
{
    public function calculate(Weight $weight): int;
}
