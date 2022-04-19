<?php

namespace Tests\Unit;

use App\Services\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSubtract()
    {
        $result = (new CalculatorService())->subtract(4, 2);

        $this->assertEquals($result);
    }
}
