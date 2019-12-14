<?php
namespace App\Mocks;

use Carbon\Carbon;
use Psy\Util\Json;

class BBCMock
{
    private $date;

    public function __construct(string $city, Carbon $date)
    {
        $this->date = $date;
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function serve(){
        return Json::encode($this->getArrayData());
    }

    /**
     * @return array
     */
    private function getArrayData(){
        return [
            "predictions" => [
                "-scale" => "Fahrenheit",
                "city" => ucfirst($this->city),
                "date" => $this->date->format('Ymd'),
                "prediction" => [
                    [
                        "time" => "00:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "01:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "02:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "03:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "04:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "05:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "06:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "07:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "08:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "09:00",
                        "value" => rand(24,31)
                    ],
                    [
                        "time" => "10:00",
                        "value" => rand(24,31)
                    ]
                ]
            ]
        ];
    }
}