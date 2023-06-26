<?php

declare(strict_types=1);

namespace Tests\App\Service;

use App\Model\Weight;
use App\Service\PackGroupCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class PackGroupCalculatorTest extends TestCase
{
    private PackGroupCalculator $packGroupCalculator;

    public function setUp(): void
    {
        $this->packGroupCalculator = new PackGroupCalculator();
    }

    public static function provideCalculatorValues(): \Generator
    {
        yield [1, 1];
        yield [28, 28];
    }

    #[DataProvider('provideCalculatorValues')]
    public function testCalculatesPackGroup(int $actualResult, int $expectedResult): void
    {
        $weight = new Weight($actualResult);
        $result = $this->packGroupCalculator->calculate($weight);
        self::assertSame($expectedResult, $result);
    }
}