<?php
namespace App\Repositories;

use App\Contracts\DegreeInterface;
use App\Services\Degrees\Fahrenheit;

class WeatherDotComRepository extends AbstractWeatherProviderRepository
{
    public function degreeOfTime(int $hour): DegreeInterface
    {
        return new Fahrenheit(10);
    }
}