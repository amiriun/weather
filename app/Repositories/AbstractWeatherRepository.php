<?php

namespace App\Repositories;

use App\Contracts\DataSourceInterface;
use App\Contracts\WeatherRepositoryInterface;
use Carbon\Carbon;

abstract class AbstractWeatherRepository  implements WeatherRepositoryInterface
{
    /**
     * @var Carbon
     */
    public $date;

    public $city;

    /**
     * @var DataSourceInterface $dataSource
     */
    protected $dataSource;

    public function __construct(string $city, Carbon $date,DataSourceInterface $dataSource)
    {
        $this->date = $date;
        $this->city = $city;
        $this->dataSource = $dataSource;
    }
}