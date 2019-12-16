<?php

namespace Tests\Feature;

use App\DataContracts\DegreeTypes;
use App\Services\ReportsAggregator;
use Tests\Stubs\FirstWeatherRepositoryStub;
use Tests\Stubs\SecondWeatherRepositoryStub;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WeatherRepositoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_should_calculate_average_using_fake_providers()
    {
        // 1. Arrange
        $service = new ReportsAggregator(
            [
                new FirstWeatherRepositoryStub(),
                new SecondWeatherRepositoryStub(),
            ]
        );

        // 2. Act
        $result = $service->average(DegreeTypes::CELSIUS);

        // 3. Assert
        $this->assertEquals(11, count($result));
        $this->assertEquals(3.5, $result[0]);

    }
}
