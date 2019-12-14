<?php
namespace App\Repositories;

class WeatherDotComRepository extends AbstractWeatherProviderRepository
{
    public function getDegreeType(): string
    {
        return self::TYPE_CELSIUS;
    }
}