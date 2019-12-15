<?php

namespace App\Repositories;

use App\Contracts\WeatherRepositoryInterface;
use Carbon\Carbon;

abstract class AbstractWeatherRepository  implements WeatherRepositoryInterface
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