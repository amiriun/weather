<?php

namespace App\Repositories;

use App\Contracts\MockDataSourceInterface;
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
     * @var MockDataSourceInterface $dataSource
     */
    protected $dataSource;

    public function __construct(string $city, Carbon $date,MockDataSourceInterface $dataSource)
    {
        $this->date = $date;
        $this->city = $city;
        $this->dataSource = $dataSource;
    }
}