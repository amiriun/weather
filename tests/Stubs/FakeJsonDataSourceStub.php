<?php
/**
 * Created by PhpStorm.
 * User: amir
 * Date: 12/17/19
 * Time: 12:48 AM
 */

namespace Tests\Stubs;

use App\Contracts\DataSourceInterface;
use Carbon\Carbon;

class FakeJsonDataSourceStub implements DataSourceInterface
{
    private $date;

    private $city;

    public function __construct(string $city, Carbon $date)
    {
        $this->date = $date;
        $this->city = $city;
    }

    public function serveRawData()
    {
        return '{
  "predictions": {
    "-scale": "Fahrenheit",
    "city": "'.$this->city.'",
    "date": "'.$this->date->format('Ymd').'",
    "prediction": [
      {
        "time": "00:00",
        "value": "31"
      },
      {
        "time": "01:00",
        "value": "32"
      },
      {
        "time": "02:00",
        "value": "25"
      },
      {
        "time": "03:00",
        "value": "26"
      },
      {
        "time": "04:00",
        "value": "20"
      },
      {
        "time": "05:00",
        "value": "22"
      },
      {
        "time": "06:00",
        "value": "23"
      },
      {
        "time": "07:00",
        "value": "22"
      },
      {
        "time": "08:00",
        "value": "25"
      },
      {
        "time": "09:00",
        "value": "24"
      },
      {
        "time": "10:00",
        "value": "24"
      }
    ]
  }
}';
    }
}