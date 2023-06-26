<?php

declare(strict_types=1);

namespace Tests\App\Model;

use App\Model\Weight;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class WeightTest extends TestCase
{
    public function testCreatesWeight(): void
    {
        $this->expectNotToPerformAssertions();
        new Weight(10);
    }

    public function testCannotCreateWeightWithZero():void
    {
        $this->expectException(InvalidArgumentException::class);
        new Weight(0);
    }
}
