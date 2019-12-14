<?php
namespace App\Services\Degrees;

use App\Contracts\DegreeInterface;

class Celsius extends AbstractDegree implements DegreeInterface
{
    public function toCelsius(): int
    {
        return $this->amount;
    }

    public function toFahrenheit(): int
    {
        // TODO: Implement toFahrenheit() method.
    }
}