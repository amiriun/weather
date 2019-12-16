<?php

namespace App\Services\Degrees;

class Fahrenheit extends AbstractDegree
{
    public function toCelsius(): float
    {
        return ($this->amount - 32) * 5/9;
    }

    public function toFahrenheit(): float
    {
        return $this->amount;
    }
}