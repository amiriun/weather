<?php
namespace App\Services;

use App\Contracts\DegreeInterface;

class Fahrenheit extends AbstractDegree implements DegreeInterface
{
    public function toCelsius(): int
    {
        // TODO: Implement toCelsius() method.
    }

    public function toFahrenheit(): int
    {
        return $this->amount;
    }
}