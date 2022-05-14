<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\CalculatorService;

class CalculatorServiceTest extends TestCase
{
    /**
     * The method should return a positive number when number1 and number2 are positive
     * @test
     * @return void
     */
    public function addShouldReturnPositiveResultWhenGivenBothNumbersArePositive(): void
    {
        $result = (new CalculatorService())->add(10, 5);

        $this->assertEquals(15, $result);
    }

    /**
     * The method should return a fraction number when number1 is float and number2 is integer
     * @test
     * @return void
     */
    public function subtractShouldReturnFractionResultWhenGivenNumber1IsFloatAndNumber2IsInt(): void
    {
        $result = (new CalculatorService())->add(5, 5);

        $this->assertEquals(10, $result);
    }
}
