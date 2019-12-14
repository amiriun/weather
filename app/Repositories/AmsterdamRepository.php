<?php
namespace App\Repositories;

use App\DataContracts\DegreeItemDTO;
use App\Services\Degrees\Celsius;

class AmsterdamRepository extends AbstractWeatherProviderRepository
{
    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array
    {
        return new Celsius(10);
    }
}