<?php

namespace Tests\Feature;

use App\Contracts\DataSourceInterface;
use App\DataSources\Amsterdam;
use App\Repositories\AmsterdamRepository;
use App\Repositories\BBCRepository;
use App\Repositories\WeatherDotComRepository;
use Carbon\Carbon;
use Tests\Stubs\FakeCSVDataSourceStub;
use Tests\Stubs\FakeJsonDataSourceStub;
use Tests\Stubs\FakeXMLDataSourceStub;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WeatherRepositoryTest extends TestCase
{
    /**
     * @return void
     */
    public function test_amsterdam_repository_with_fake_data()
    {
        $date = Carbon::now();
        $city = 'lalaland';
        $fakeDataSource = new FakeXMLDataSourceStub($city, $date);
        $repository = new AmsterdamRepository($city, $date, $fakeDataSource);
        $report = $repository->degreeOfDay();


        $this->assertEquals(10,$report[0]->degree->toCelsius());
        $this->assertEquals(6,$report[10]->degree->toCelsius());
        $this->assertEquals(0,$report[0]->hour);
        $this->assertEquals(10,$report[10]->hour);
    }

    /**
     * @return void
     */
    public function test_bbc_repository_with_fake_data()
    {
        $date = Carbon::now();
        $city = 'lalaland';
        $fakeDataSource = new FakeJsonDataSourceStub($city, $date);
        $repository = new BBCRepository($city, $date, $fakeDataSource);
        $report = $repository->degreeOfDay();


        $this->assertEquals(31,$report[0]->degree->toFahrenheit());
        $this->assertEquals(24,$report[10]->degree->toFahrenheit());
        $this->assertEquals(0,$report[0]->hour);
        $this->assertEquals(10,$report[10]->hour);
    }

    /**
     * @return void
     */
    public function test_weather_dot_com_repository_with_fake_data()
    {
        $date = Carbon::now();
        $city = 'lalaland';
        $fakeDataSource = new FakeCSVDataSourceStub($city, $date);
        $repository = new WeatherDotComRepository($city, $date, $fakeDataSource);
        $report = $repository->degreeOfDay();


        $this->assertEquals(5,$report[0]->degree->toCelsius());
        $this->assertEquals(3,$report[10]->degree->toCelsius());
        $this->assertEquals(0,$report[0]->hour);
        $this->assertEquals(10,$report[10]->hour);
    }
}
