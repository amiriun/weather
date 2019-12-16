<?php
/**
 * Created by PhpStorm.
 * User: amir
 * Date: 12/16/19
 * Time: 6:32 PM
 */

namespace Tests\Stubs;

use App\Contracts\WeatherRepositoryInterface;
use App\DataContracts\DegreeItemDTO;
use App\Services\Degrees\Celsius;

class SecondWeatherRepositoryStub implements WeatherRepositoryInterface
{
    /**
     * @return DegreeItemDTO[]
     */
    public function degreeOfDay(): array
    {
        $DTOArray = [];
        for($i=0; $i<=10;$i++){
            $DTO  = new DegreeItemDTO();
            $DTO->hour = $i;
            $DTO->degree = new Celsius(5);

            $DTOArray[] = $DTO;
        }

       return $DTOArray;
    }
}