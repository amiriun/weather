<?php
/**
 * Created by PhpStorm.
 * User: amir
 * Date: 12/16/19
 * Time: 6:32 PM
 */

namespace Tests\Stubs;

use App\Contracts\DataSourceInterface;
use App\Contracts\WeatherRepositoryInterface;
use App\DataContracts\DegreeItemDTO;
use App\Repositories\AbstractWeatherRepository;
use App\Services\Degrees\Celsius;
use Carbon\Carbon;

class FirstWeatherRepositoryStub extends AbstractWeatherRepository implements WeatherRepositoryInterface
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
            $DTO->degree = new Celsius(2);

            $DTOArray[] = $DTO;
        }

       return $DTOArray;
    }
}