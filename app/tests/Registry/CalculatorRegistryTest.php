<?php

declare(strict_types=1);

namespace Tests\App\Registry;

use App\Registry\CalculatorRegistry;
use App\Service\PackGroupCalculator;
use PHPUnit\Framework\TestCase;

final class CalculatorRegistryTest extends TestCase
{
    private readonly CalculatorRegistry $calculatorRegistry;

    public function setUp(): void
    {
       $this->calculatorRegistry = new CalculatorRegistry();
       $this->calculatorRegistry->register('packGroup', new PackGroupCalculator());
    }

    public function testResolvesCalculator(): void
    {
        $calculator = $this->calculatorRegistry->resolve('packGroup');
        self::assertEquals(new PackGroupCalculator(), $calculator);
    }

    public function testCannotUseNonExistentKey(): void
    {
        $this->expectException(\Exception::class);
        $this->calculatorRegistry->resolve('null');
    }
}