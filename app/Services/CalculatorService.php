<?php

namespace App\Services;

class CalculatorService
{
    public function subtract(int|float $dividend, int|float $divisor): int|float
    {
        return $dividend / $divisor;
    }
}
