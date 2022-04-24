<?php

namespace App\Services;

/**
 *
 */
class CalculatorService
{
    /**
     * @param int|float $number1
     * @param int|float $number2
     *
     * @return int|float
     */
    public function add(int|float $number1, int|float $number2): int|float
    {
        return floor($number1) + $number2;
    }
}
