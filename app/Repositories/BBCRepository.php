<?php

namespace App\Repositories;

use App\DataContracts\DegreeItemDTO;
use App\Mocks\BBCMock;
use App\Services\Degrees\Fahrenheit;
use Illuminate\Support\Arr;

class BBCRepository extends AbstractWeatherRepository
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
        $this->collectDataFromJson();

        return $this->decorateData();
    }

    private function collectDataFromJson(): void
    {
        $value = json_decode($this->dataSource->serveRawData());
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
            $DTO->degree = app('bbc_default_degree_scale',Arr::wrap($item->value));

            $degreeItemDTO[] = $DTO;
        }

        return $degreeItemDTO;
    }
}