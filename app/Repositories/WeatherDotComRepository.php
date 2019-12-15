<?php
namespace App\Repositories;

use App\DataContracts\DegreeItemDTO;
use App\Mocks\WeatherDotComMock;
use App\Services\CSV;
use App\Services\Degrees\Celsius;

class WeatherDotComRepository extends AbstractWeatherProviderRepository
{
    private $rawData;

    /**
     * @var array
     */
    private $dataArray;

    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array
    {
        $this->getFromSource();
        $this->collectDataFromCSV();

        return $this->decorateData();
    }

    private function getFromSource()
    {
        $data = new WeatherDotComMock($this->city, $this->date);
        $this->rawData = $data->serveAsCSV();
    }

    private function collectDataFromCSV()
    {
        $csv = (new CSV($this->rawData));
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
            $DTO->degree = new Celsius($item['prediction__value']);

            $degreeItemDTO[] = $DTO;
        }

        return $degreeItemDTO;
    }
}