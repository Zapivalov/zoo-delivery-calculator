<?php

declare(strict_types=1);

namespace Tests\App\Service;

use App\Model\Weight;
use App\Service\TransCompanyCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class TransCompanyCalculatorTest extends TestCase
{
    private TransCompanyCalculator $transCompanyCalculator;

    public function setUp(): void
    {
        $this->transCompanyCalculator = new TransCompanyCalculator();
    }
    public static function provideCalculatorValues(): \Generator
    {
        yield [1, 20];
        yield [28, 100];
    }

    #[DataProvider('provideCalculatorValues')]
    public function testCalculatesTransCompany(int $actualResult, int $expectedResult): void
    {
        $weight = new Weight($actualResult);
        $result = $this->transCompanyCalculator->calculate($weight);
        self::assertSame($expectedResult, $result);
    }
}