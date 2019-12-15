<?php

namespace App\Services;

use App\Contracts\ReportsAggregatorInterface;
use App\Contracts\WeatherProviderRepositoryInterface;
use Illuminate\Support\Arr;

class ReportsAggregatorProxy implements ReportsAggregatorInterface
{
    private $repositories;

    private $cacheInMinutes;

    /**
     * ReportAggregatorProxy constructor.
     *
     * @param WeatherProviderRepositoryInterface[] $repositories
     * @param int $cacheInMinutes
     */
    public function __construct($repositories,$cacheInMinutes = 1)
    {
        $this->repositories = $repositories;
        $this->cacheInMinutes =  $cacheInMinutes;
    }

    /**
     * @param $degreeType
     * @return array
     * @throws \Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function average($degreeType): array
    {
        $aggregator = new ReportsAggregator($this->repositories);
        if (cache()->has($this->cacheKey())) {
            return cache($this->cacheKey());
        }
        $average = $aggregator->average($degreeType);
        cache()->put($this->cacheKey(), $average, $this->cacheInMinutes*60);

        return $average;
    }

    private function cacheKey()
    {
        $getOneRepository = Arr::first($this->repositories);

        return "{$getOneRepository->date->timestamp}_{$getOneRepository->city}_{$this->cacheInMinutes}";
    }
}