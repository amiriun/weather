<?php

namespace Tests\Feature;

use App\DataContracts\DegreeTypes;
use App\DataSources\Amsterdam;
use App\DataSources\BBC;
use App\DataSources\WeatherDotCom;
use Carbon\Carbon;
use Tests\TestCase;

class DataSourceTest extends TestCase
{
    /**
     * @return void
     */
    public function test_amsterdam_datasource()
    {
        $city = 'lalaLand';
        $date = Carbon::now();
        $dataSource = new Amsterdam($city, $date);

        $rawXML = $dataSource->serveRawData();
        $collect = (array) simplexml_load_string($rawXML);

        $this->assertArrayHasKey('prediction', $collect);
        $this->assertEquals($collect['city'], $city);
        $this->assertEquals($collect['date'], $date->format('Ymd'));
    }

    /**
     * @return void
     */
    public function test_bbc_datasource()
    {
        $city = 'LalaLand';
        $date = Carbon::now();
        $dataSource = new BBC($city, $date);

        $rawJson = $dataSource->serveRawData();
        $collect = json_decode($rawJson);

        $this->assertEquals(DegreeTypes::FAHRENHEIT, $collect->predictions->{'-scale'});
        $this->assertEquals($city, $collect->predictions->city);
        $this->assertEquals($date->format('Ymd'), $collect->predictions->date);
    }

    /**
     * @return void
     */
    public function test_weather_dot_com_datasource()
    {
        $city = 'LalaLand';
        $date = Carbon::now();
        $dataSource = new WeatherDotCom($city, $date);

        $rawCSV = $dataSource->serveRawData();
        $collect = app('csv',[$rawCSV])->toArray();

        $this->assertEquals(strtolower(DegreeTypes::CELSIUS), $collect[0]['-scale']);
        $this->assertEquals($city, $collect[0]['city']);
        $this->assertEquals($date->format('Ymd'), $collect[0]['date']);
    }
}
