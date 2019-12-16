<?php
namespace App\Services\Degrees;

class Celsius extends AbstractDegree
{
    public function toCelsius(): float
    {
        return $this->amount;
    }

    public function toFahrenheit(): float
    {
        return ($this->amount*9/5)+32;
    }
}