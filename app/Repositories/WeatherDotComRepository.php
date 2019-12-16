<?php
namespace App\Repositories;

use App\DataContracts\DegreeItemDTO;
use Illuminate\Support\Arr;

class WeatherDotComRepository extends AbstractWeatherRepository
{
    /**
     * @var array
     */
    private $dataArray;

    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array
    {
        $this->collectDataFromCSV();

        return $this->decorateData();
    }

    private function collectDataFromCSV()
    {
        $csv = app('csv',[$this->dataSource->serveRawData()]);
        $this->dataArray = $csv->toArray();
    }

    /**
     * @return DegreeItemDTO[]
     */
    private function decorateData()
    {
        $degreeItemDTO = [];
        foreach ($this->dataArray as $item){
            $DTO = new DegreeItemDTO();
            $DTO->hour = (int)str_replace(':00', '', $item['prediction__time']);
            $DTO->degree = app('weather_dot_com_default_degree_scale',Arr::wrap($item['prediction__value']));

            $degreeItemDTO[] = $DTO;
        }

        return $degreeItemDTO;
    }
}