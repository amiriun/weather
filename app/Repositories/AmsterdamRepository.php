<?php
namespace App\Repositories;

use App\Contracts\DegreeInterface;
use App\Services\Degrees\Celsius;

class AmsterdamRepository extends AbstractWeatherProviderRepository
{
    public function degreeOfTime(int $hour): DegreeInterface
    {
        return new Celsius(10);
    }
}