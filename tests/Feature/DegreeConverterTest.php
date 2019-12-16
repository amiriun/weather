<?php

namespace Tests\Feature;

use App\Services\Degrees\Celsius;
use App\Services\Degrees\Fahrenheit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DegreeConverterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_celsius_to_celsius_amounts_being_same()
    {
        $inputAmount = 1;
        $service = new Celsius($inputAmount);


        $this->assertEquals($inputAmount,$service->toCelsius());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_celsius_to_fahrenheit_result()
    {
        $celsiusAmount = 1;
        $fahrenheitAmount = 33.8;
        $service = new Celsius($celsiusAmount);


        $this->assertEquals($fahrenheitAmount, $service->toFahrenheit());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fahrenheit_to_fahrenheit_being_same()
    {
        $service = new Fahrenheit(33.8);

        $this->assertEquals(33.8, $service->toFahrenheit());
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fahrenheit_to_celsius_result()
    {
        $fahrenheit = 33.8;
        $celsius = 1;
        $service = new Fahrenheit($fahrenheit);

        $this->assertEquals($celsius, $service->toCelsius());
    }
}
