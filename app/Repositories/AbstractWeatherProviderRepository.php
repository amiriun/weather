<?php

namespace App\Repositories;

use App\Contracts\WeatherProviderRepositoryInterface;

abstract class AbstractWeatherProviderRepository  implements WeatherProviderRepositoryInterface
{
    protected $rawData;

    public function __construct(string $rawData)
    {
        $this->rawData = $rawData;
    }
}