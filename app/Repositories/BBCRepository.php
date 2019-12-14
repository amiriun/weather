<?php

namespace App\Repositories;

use App\Contracts\DegreeInterface;
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
     * @var Collection
     */
    private $dataObject;

    public function degreeOfTime(int $hour): DegreeInterface
    {
        $this->getRawData();
        $this->rawDataToObject();
        $filteredTime = $this->whereHourEqualTo($hour);

        return new Fahrenheit($filteredTime->value);
    }

    private function getRawData(): void
    {
        $data = new BBCMock($this->city, $this->date);
        $this->rawData = $data->serve();
    }

    private function rawDataToObject(): void
    {
        $value = json_decode($this->rawData);
        $this->dataObject = collect($value->predictions->prediction);
    }

    /**
     * @param int $hour
     * @return mixed
     */
    private function whereHourEqualTo(int $hour): mixed
    {
        return $this->dataObject->filter(
            function ($item) use ($hour) {
                return $item->time == $this->hourFormat($hour);
            }
        )->first();
    }
}