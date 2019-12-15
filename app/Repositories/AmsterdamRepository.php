<?php
namespace App\Repositories;

use App\DataContracts\DegreeItemDTO;
use App\Mocks\AmsterdamMock;
use App\Services\Degrees\Celsius;

class AmsterdamRepository extends AbstractWeatherRepository
{
    private $rawData;

    private $dataArray;

    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array
    {
        $this->getFromSource();
        $this->collectDataFromXML();

        return $this->decorateData();
    }

    private function getFromSource()
    {
        $data = new AmsterdamMock($this->city, $this->date);
        $this->rawData = $data->serveAsXML();
    }

    private function collectDataFromXML()
    {
        $decodedData = (array)simplexml_load_string($this->rawData);
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
            $DTO->degree = new Celsius((int)$item->value);

            $degreeItemDTO[] = $DTO;
        }

        return $degreeItemDTO;
    }
}