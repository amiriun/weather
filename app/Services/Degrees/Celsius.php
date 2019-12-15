<?php
namespace App\Services\Degrees;

class Celsius extends AbstractDegree
{
    public function toCelsius(): int
    {
        return $this->amount;
    }

    public function toFahrenheit(): int
    {
        return ($this->amount*9.5)+32;
    }
}