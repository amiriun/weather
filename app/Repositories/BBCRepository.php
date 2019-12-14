<?php
namespace App\Repositories;

class BBCRepository extends AbstractWeatherProviderRepository
{
    public function getDegreeType(): string
    {
        return self::TYPE_FAHRENHEIT;
    }
}