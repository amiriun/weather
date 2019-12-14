<?php
namespace App\Repositories;

use App\Contracts\DegreeInterface;
use App\DataContracts\DegreeItemDTO;
use App\Services\Degrees\Fahrenheit;
use Illuminate\Support\Collection;

class WeatherDotComRepository extends AbstractWeatherProviderRepository
{
    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array
    {
        return new Fahrenheit(10);
    }
}