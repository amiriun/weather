<?php

namespace Tests\Feature;

use App\Contracts\DataSourceInterface;
use App\DataContracts\DegreeTypes;
use App\Services\ReportsAggregator;
use App\Services\ReportsAggregatorProxy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Tests\Stubs\FirstWeatherRepositoryStub;
use Tests\Stubs\SecondWeatherRepositoryStub;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportsAggregatorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_should_calculate_average_using_fake_providers()
    {
        $mockDataSource = \Mockery::mock(DataSourceInterface::class)->shouldAllowMockingMethod('serveRawData');

        // 1. Arrange
        $service = new ReportsAggregator(
            [
                new FirstWeatherRepositoryStub('test city',Carbon::now(),$mockDataSource),
                new SecondWeatherRepositoryStub('test city',Carbon::now(),$mockDataSource),
            ]
        );

        // 2. Act
        $result = $service->average(DegreeTypes::CELSIUS);

        // 3. Assert
        $this->assertIsArray($result);
        $this->assertEquals(11, count($result));
        $this->assertEquals(3.5, $result[0]);


    }

    public function test_putting_average_data_into_cache_at_the_first_time(){
        $mockDataSource = \Mockery::mock(DataSourceInterface::class)->shouldAllowMockingMethod('serveRawData');
        $repositories = [
            new FirstWeatherRepositoryStub('test city',Carbon::now(),$mockDataSource),
            new SecondWeatherRepositoryStub('test city',Carbon::now(),$mockDataSource),
        ];
        $aggregator = new ReportsAggregatorProxy($repositories,1);
        Cache::shouldReceive('has','put')->once();
        $aggregator->average(DegreeTypes::CELSIUS);
    }

    public function test_getting_average_data_from_cache_since_second_time(){
        $mockDataSource = \Mockery::mock(DataSourceInterface::class)->shouldAllowMockingMethod('serveRawData');
        $repositories = [
            new FirstWeatherRepositoryStub('test city',Carbon::now(),$mockDataSource),
            new SecondWeatherRepositoryStub('test city',Carbon::now(),$mockDataSource),
        ];
        $aggregator = new ReportsAggregatorProxy($repositories,1);
        Cache::shouldReceive('has')->andReturn(true);
        Cache::shouldReceive('get')->andReturn([0=>1]);
        $aggregator->average(DegreeTypes::CELSIUS);
    }
}
