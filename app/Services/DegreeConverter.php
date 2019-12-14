<?php
namespace App\Services;

class DegreeConverter
{
    private $amount;

    private $type;

    public function __construct($degreeAmount,$degreeType)
    {
        $this->amount = $degreeAmount;
        $this->type = $degreeType;
    }

    public function toCelsius(){
        // todo ...
    }

    public function toFahrenheit(){
        // todo ...
    }
}