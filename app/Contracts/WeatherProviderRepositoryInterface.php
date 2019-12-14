<?php
namespace App\Contracts;


interface WeatherProviderRepositoryInterface
{
    public function degreeOfTime(int $hour) : DegreeInterface;
}