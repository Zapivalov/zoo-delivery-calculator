<?php

declare(strict_types=1);

namespace App\Model;

use Webmozart\Assert\Assert;

final class Weight
{
    public function __construct(
        public readonly int $value,
    ) {
        Assert::positiveInteger($this->value);
    }
}
