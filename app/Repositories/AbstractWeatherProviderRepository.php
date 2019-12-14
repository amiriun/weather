<?php

namespace App\Repositories;

use App\Contracts\WeatherProviderRepositoryInterface;
use Carbon\Carbon;

abstract class AbstractWeatherProviderRepository  implements WeatherProviderRepositoryInterface
{
    /**
     * @var Carbon
     */
    protected $date;

    protected $city;

    public function __construct(string $city, Carbon $date)
    {
        $this->date = $date;
        $this->city = $city;
    }

    protected function hourFormat($hour){
        if($hour < 10){
            return "0"."{$hour}:00";
        }

        return "{$hour}:00";
    }
}