<?php
namespace App\Repositories;

class BBCProviderRepository extends AbstractWeatherProviderRepository
{
    public function getDegreeType(): string
    {
        return self::TYPE_FAHRENHEIT;
    }
}