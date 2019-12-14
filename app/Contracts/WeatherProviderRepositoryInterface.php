<?php
namespace App\Contracts;

use App\Services\DegreeConverter;

interface WeatherProviderRepositoryInterface
{
    public function degreeOfTime(int $hour) : DegreeConverter;

    public function getDegreeType() : string;
}