<?php

namespace App\Contracts;

use App\DataContracts\DegreeItemDTO;
use Carbon\Carbon;

/**
 * Interface WeatherProviderRepositoryInterface
 *
 * @package App\Contracts
 * @property string city
 * @property Carbon date
 */
interface WeatherProviderRepositoryInterface
{
    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array;
}