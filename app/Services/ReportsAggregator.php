<?php

namespace App\Services;

use App\Contracts\ReportsAggregatorInterface;
use App\Contracts\WeatherRepositoryInterface;
use App\DataContracts\DegreeItemDTO;

class ReportsAggregator implements ReportsAggregatorInterface
{
    /**
     * @var WeatherRepositoryInterface[]
     */
    private $repositories;

    /**
     * ReportAggregator constructor.
     *
     * @param WeatherRepositoryInterface[] $repositories
     */
    public function __construct($repositories)
    {
        $this->repositories = $repositories;
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
            $averageList[$hour] = $this->calculateAverage($dailyDegreeItems, $degreeType);
        }

        return $averageList;
    }

    /**
     * @param DegreeItemDTO[] $items
     * @param string $degreeType
     *
     * @return int
     */
    private function calculateAverage($items,$degreeType) : int
    {
        $sum = 0;
        foreach ($items as $item) {
            $method = 'to'.$degreeType;
            $sum = $sum + $item->degree->$method();
        }

        return $sum / count($items);
    }
}