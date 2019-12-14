<?php

namespace App\Contracts;

use App\DataContracts\DegreeItemDTO;

interface WeatherProviderRepositoryInterface
{
    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array;
}