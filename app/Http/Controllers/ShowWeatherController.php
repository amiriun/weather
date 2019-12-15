<?php

namespace App\Http\Controllers;

use App\DataContracts\DegreeTypes;
use App\Http\Requests\ShowWeatherRequest;
use App\Http\Resources\RestApiTransformer;
use App\Repositories\AmsterdamRepository;
use App\Repositories\BBCRepository;
use App\Repositories\WeatherDotComRepository;
use App\Services\ReportsAggregatorProxy;
use Psr\SimpleCache\InvalidArgumentException;

class ShowWeatherController extends Controller
{
    private $DTO;

    public function __construct(ShowWeatherRequest $request)
    {
        $this->DTO = $request->getDTO();
    }

    /**
     * @param string $city
     * @return \App\Http\Resources\RestApiTransformer|\Illuminate\Http\Response
     */
    public function show($city){
        try {
            $cacheTimeInMinute = 1;
            $repositories = [
                new BBCRepository($city, $this->DTO->date),
                new WeatherDotComRepository($city, $this->DTO->date),
                new AmsterdamRepository($city, $this->DTO->date),
            ];
            $reportAggregatorProxy = new ReportsAggregatorProxy($repositories, $cacheTimeInMinute);
            $average = $reportAggregatorProxy->average($this->getDegreeType());
        } catch (\Exception $e) {
            abort(422,'Problem was occured');
        } catch (InvalidArgumentException $e) {
            abort(422,'Problem was occured');
        }

        return new RestApiTransformer($average);
    }

    /**
     * @return string
     */
    private function getDegreeType()
    {
        if($this->DTO->degreeType == strtolower(DegreeTypes::CELSIUS)){
            return DegreeTypes::CELSIUS;
        }
        if($this->DTO->degreeType == strtolower(DegreeTypes::FAHRENHEIT)){
            return DegreeTypes::FAHRENHEIT;
        }

        return DegreeTypes::CELSIUS;
    }
}
