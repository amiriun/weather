<?php

namespace App\Mocks;

use App\Contracts\MockDataSourceInterface;
use Carbon\Carbon;

class WeatherDotComMock implements MockDataSourceInterface
{
    private $date;

    private $city;

    public function __construct(string $city, Carbon $date)
    {
        $this->date = $date;
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function serveRawData()
    {
        return $this->getRawData();
    }

    /**
     * @return string
     */
    private function getRawData()
    {
        return "\"-scale\",\"city\",\"date\",\"prediction__time\",\"prediction__value\"
\"celsius\",\"{$this->city}\",\"{$this->date->format('Ymd')}\",\"00:00\",\"05\"
\"\",\"\",\"\",\"01:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"02:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"03:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"04:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"05:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"06:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"07:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"08:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"09:00\",\"".rand(5,10)."\"
\"\",\"\",\"\",\"10:00\",\"".rand(5,10)."\"
";
    }
}