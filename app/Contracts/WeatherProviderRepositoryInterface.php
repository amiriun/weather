<?php
namespace App\Contracts;

use App\Services\AbstractDegree;

interface WeatherProviderRepositoryInterface
{
    public function degreeOfTime(int $hour) : DegreeInterface;
}