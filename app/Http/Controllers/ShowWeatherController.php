<?php

namespace App\Http\Controllers;

use App\DataContracts\DegreeTypes;
use App\Http\Requests\ShowWeatherRequest;
use App\Http\Resources\ShowWeatherTransformer;
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
     * @return \App\Http\Resources\ShowWeatherTransformer|\Illuminate\Http\Response
     */
    public function show($city){
        try {
            $reportAggregatorProxy = app('reports_aggregator_proxy',[$city, $this->DTO->date]);
            $average = $reportAggregatorProxy->average($this->specifyDegreeType());
        } catch (\Exception $e) {
            abort(422,'Problem was occured');
        } catch (InvalidArgumentException $e) {
            abort(422,'Problem was occured');
        }

        return new ShowWeatherTransformer($average);
    }

    /**
     * @return string
     */
    private function specifyDegreeType()
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
