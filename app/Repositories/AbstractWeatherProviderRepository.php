<?php
namespace App\Repositories;

abstract class AbstractWeatherProviderRepository
{
    protected $rawData;

    public function __construct(string $rawData)
    {
        $this->rawData = $rawData;
    }
}