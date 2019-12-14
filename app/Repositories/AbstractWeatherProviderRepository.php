<?php

namespace App\Repositories;

use App\Contracts\WeatherProviderRepositoryInterface;
use App\Services\DegreeConverter;

abstract class AbstractWeatherProviderRepository  implements WeatherProviderRepositoryInterface
{
    const TYPE_FAHRENHEIT = 'fahrenheit';

    const TYPE_CELSIUS = 'celsius';

    const TYPE_REAUMUR = 'reaumur';

    const TYPE_NEWTON = 'newton';

    const TYPE_ROMER = 'romer';

    protected $rawData;

    public function __construct(string $rawData)
    {
        $this->rawData = $rawData;
    }

    public function degreeOfTime(int $hour): DegreeConverter
    {
        return new DegreeConverter(10,$this->getDegreeType());
    }
}