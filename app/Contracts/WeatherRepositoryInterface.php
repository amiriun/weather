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
interface WeatherRepositoryInterface
{
    /**
     * WeatherRepositoryInterface constructor.
     *
     * @param string $city
     * @param \Carbon\Carbon $date
     * @param \App\Contracts\DataSourceInterface $dataSource
     */
    public function __construct(string $city, Carbon $date,DataSourceInterface $dataSource);

    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array;
}