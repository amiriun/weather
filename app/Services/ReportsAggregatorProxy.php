<?php

namespace App\Services;

use App\Contracts\ReportsAggregatorInterface;
use App\Contracts\WeatherRepositoryInterface;
use Illuminate\Support\Arr;

class ReportsAggregatorProxy implements ReportsAggregatorInterface
{
    private $repositories;

    private $cacheInMinutes;

    /**
     * ReportAggregatorProxy constructor.
     *
     * @param WeatherRepositoryInterface[] $repositories
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
        $aggregator = app(ReportsAggregatorInterface::class,$this->repositories);
        if (cache()->has($this->cacheKey($degreeType))) {
            return cache($this->cacheKey($degreeType));
        }
        $average = $aggregator->average($degreeType);
        cache()->put($this->cacheKey($degreeType), $average, $this->cacheInMinutes*60);

        return $average;
    }

    private function cacheKey($degreeType)
    {
        $getOneRepository = Arr::first($this->repositories);

        return "{$degreeType}_{$getOneRepository->date->timestamp}_{$getOneRepository->city}_{$this->cacheInMinutes}";
    }
}