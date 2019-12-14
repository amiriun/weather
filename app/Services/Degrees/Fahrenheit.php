<?php

namespace App\Services\Degrees;

use App\Contracts\DegreeInterface;

class Fahrenheit extends AbstractDegree implements DegreeInterface
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