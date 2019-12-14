<?php
namespace App\Repositories;

class AmsterdamRepository extends AbstractWeatherProviderRepository
{
    public function getDegreeType(): string
    {
        return self::TYPE_CELSIUS;
    }
}