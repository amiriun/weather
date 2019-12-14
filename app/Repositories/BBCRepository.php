<?php
namespace App\Repositories;

use App\Contracts\DegreeInterface;
use App\Services\Fahrenheit;

class BBCRepository extends AbstractWeatherProviderRepository
{
    public function degreeOfTime(int $hour): DegreeInterface
    {
        return new Fahrenheit(10);
    }
}