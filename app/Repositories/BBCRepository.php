<?php

namespace App\Repositories;

use App\DataContracts\DegreeItemDTO;
use App\Mocks\BBCMock;
use App\Services\Degrees\Fahrenheit;
use Illuminate\Support\Collection;

class BBCRepository extends AbstractWeatherProviderRepository
{
    /**
     * @var string
     */
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
        $this->collectData();

        return $this->decorateData();
    }

    private function getFromSource(): void
    {
        $data = new BBCMock($this->city, $this->date);
        $this->rawData = $data->serveAsJson();
    }

    private function collectData(): void
    {
        $value = json_decode($this->rawData);
        $this->dataArray = $value->predictions->prediction;
    }

    /**
     * @return DegreeItemDTO[]
     */
    private function decorateData()
    {
        $degreeItemDTO = [];
        foreach ($this->dataArray as $item){
            $DTO = new DegreeItemDTO();
            $DTO->hour = (int)str_replace(':00', '', $item->time);
            $DTO->degree = new Fahrenheit($item->value);

            $degreeItemDTO[] = $DTO;
        }

        return $degreeItemDTO;
    }
}