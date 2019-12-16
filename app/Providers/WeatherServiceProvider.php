<?php

namespace App\Providers;

use App\Mocks\AmsterdamMock;
use App\Mocks\BBCMock;
use App\Mocks\WeatherDotComMock;
use App\Services\Degrees\Celsius;
use App\Services\Degrees\Fahrenheit;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->providersDegreeScale();
        $this->dataSources();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    private function providersDegreeScale(): void
    {
        $this->app->bind(
            'bbc_default_degree_scale',
            function ($app, array $parameters = []) {
                return new Fahrenheit($parameters[0]);
            }
        );
        $this->app->bind(
            'weather_dot_com_default_degree_scale',
            function ($app, array $parameters = []) {
                return new Celsius($parameters[0]);
            }
        );
        $this->app->bind(
            'amsterdam_default_degree_scale',
            function ($app, array $parameters = []) {
                return new Celsius($parameters[0]);
            }
        );
    }

    private function dataSources(): void
    {
        $this->app->bind(
            'amsterdam_data_source',
            function ($app, array $parameters = []) {
                return new AmsterdamMock($parameters[0], $parameters[1]);
            }
        );
        $this->app->bind(
            'weather_dot_com_data_source',
            function ($app, array $parameters = []) {
                return new WeatherDotComMock($parameters[0], $parameters[1]);
            }
        );
        $this->app->bind(
            'bbc_data_source',
            function ($app, array $parameters = []) {
                return new BBCMock($parameters[0], $parameters[1]);
            }
        );
    }
}
