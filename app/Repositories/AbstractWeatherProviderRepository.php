<?php

namespace App\Repositories;

use App\Contracts\WeatherProviderRepositoryInterface;
use Carbon\Carbon;

abstract class AbstractWeatherProviderRepository  implements WeatherProviderRepositoryInterface
{
    /**
     * @var Carbon
     */
    public $date;

    public $city;

    public function __construct(string $city, Carbon $date)
    {
        $this->date = $date;
        $this->city = $city;
    }
}