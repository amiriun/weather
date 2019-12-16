<?php
namespace App\Repositories;

use App\DataContracts\DegreeItemDTO;
use App\Mocks\AmsterdamMock;
use App\Services\Degrees\Celsius;
use Illuminate\Support\Arr;

class AmsterdamRepository extends AbstractWeatherRepository
{
    private $dataArray;

    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array
    {
        $this->collectDataFromXML();

        return $this->decorateData();
    }

    private function collectDataFromXML()
    {
        $decodedData = (array)simplexml_load_string($this->dataSource->serveRawData());
        $this->dataArray = $decodedData['prediction'];
    }

    /**
     * @return DegreeItemDTO[]
     */
    private function decorateData()
    {
        $degreeItemDTO = [];
        foreach ($this->dataArray as $item){
            $DTO = new DegreeItemDTO();
            $DTO->hour = (int)str_replace(':00', '', (string)$item->time);
            $DTO->degree = app('degree_scale.amsterdam',Arr::wrap((int)$item->value));

            $degreeItemDTO[] = $DTO;
        }

        return $degreeItemDTO;
    }
}