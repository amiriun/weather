<?php

namespace App\Services\Degrees;

class Fahrenheit extends AbstractDegree
{
    public function toCelsius(): int
    {
        return ($this->amount - 32) * 5.9;
    }

    public function toFahrenheit(): int
    {
        return $this->amount;
    }
}