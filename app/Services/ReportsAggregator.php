<?php

namespace App\Services;

use App\Contracts\ReportsAggregatorInterface;
use App\Contracts\WeatherProviderRepositoryInterface;
use App\DataContracts\DegreeItemDTO;

class ReportsAggregator implements ReportsAggregatorInterface
{
    /**
     * @var WeatherProviderRepositoryInterface[]
     */
    private $repositories;

    /**
     * ReportAggregator constructor.
     *
     * @param WeatherProviderRepositoryInterface[] ...$weatherRepositories
     */
    public function __construct($weatherRepositories)
    {
        $this->repositories = $weatherRepositories;
    }

    /**
     * @param $degreeType
     * @return array
     */
    public function average($degreeType): array
    {
        $result = collect();
        $averageList = [];
        foreach ($this->repositories as $repository) {
            $result = $result->merge($repository->degreeOfDay());
        }

        foreach ($result->groupBy('hour') as $hour=> $dailyDegreeItems) {
            $averageList[$hour] = $this->getAverageDegree($dailyDegreeItems, $degreeType);
        }

        return $averageList;
    }

    /**
     * @param DegreeItemDTO[] $items
     * @param string $degreeType
     *
     * @return int
     */
    private function getAverageDegree($items,$degreeType) : int
    {
        $sum = 0;
        foreach ($items as $item) {
            $method = 'to'.$degreeType;
            $sum = $sum + $item->degree->$method();
        }

        return round($sum / count($items));
    }
}