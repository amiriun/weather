<?php

namespace App\DataSources;

use App\Contracts\DataSourceInterface;
use Carbon\Carbon;

class WeatherDotCom implements DataSourceInterface
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
\"celsius\",\"{$this->city}\",\"{$this->date->format('Ymd')}\",\"00:00\",\"".($this->date->format('d')+0)."\"
\"\",\"\",\"\",\"01:00\",\"".($this->date->format('d')+4)."\"
\"\",\"\",\"\",\"02:00\",\"".($this->date->format('d')+1)."\"
\"\",\"\",\"\",\"03:00\",\"".($this->date->format('d')+2)."\"
\"\",\"\",\"\",\"04:00\",\"".($this->date->format('d')-1)."\"
\"\",\"\",\"\",\"05:00\",\"".($this->date->format('d')+1)."\"
\"\",\"\",\"\",\"06:00\",\"".($this->date->format('d')+4)."\"
\"\",\"\",\"\",\"07:00\",\"".($this->date->format('d')+5)."\"
\"\",\"\",\"\",\"08:00\",\"".($this->date->format('d')+2)."\"
\"\",\"\",\"\",\"09:00\",\"".($this->date->format('d')+1)."\"
\"\",\"\",\"\",\"10:00\",\"".($this->date->format('d')+8)."\"
";
    }
}