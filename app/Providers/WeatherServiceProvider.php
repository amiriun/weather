<?php

namespace App\Providers;

use App\Contracts\ReportsAggregatorInterface;
use App\Mocks\AmsterdamMock;
use App\Mocks\BBCMock;
use App\Mocks\WeatherDotComMock;
use App\Repositories\AmsterdamRepository;
use App\Repositories\BBCRepository;
use App\Repositories\WeatherDotComRepository;
use App\Services\Degrees\Celsius;
use App\Services\Degrees\Fahrenheit;
use App\Services\ReportsAggregator;
use App\Services\ReportsAggregatorProxy;
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
        $this->bindAggregatorClass();
        $this->bindRepositories();
        $this->bindReportAggregators();
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

    private function bindAggregatorClass(): void
    {
        $this->app->bind(
            ReportsAggregatorInterface::class,
            function ($app, array $parameters = []) {
                return new ReportsAggregator($parameters);
            }
        );
    }

    private function bindRepositories()
    {
        $this->app->bind(
            'bbc_repository',
            function ($app, array $parameters = []) {
                return new BBCRepository($parameters[0],$parameters[1]);
            }
        );
        $this->app->bind(
            'weather_dot_com_repository',
            function ($app, array $parameters = []) {
                return new WeatherDotComRepository($parameters[0],$parameters[1]);
            }
        );
        $this->app->bind(
            'amsterdam_repository',
            function ($app, array $parameters = []) {
                return new AmsterdamRepository($parameters[0],$parameters[1]);
            }
        );
    }

    private function bindReportAggregators()
    {
        $this->app->bind(
            ReportsAggregatorInterface::class,
            function ($app, array $parameters = []) {
                return new ReportsAggregator($parameters);
            }
        );

        $this->app->bind(
            'reports_aggregator_proxy',
            function ($app, array $parameters = []) {
                $cacheTimeInMinute = config('weather.cache_time_in_minutes');
                $repositories = [
                    app('bbc_repository',$parameters),
                    app('weather_dot_com_repository',$parameters),
                    app('amsterdam_repository',$parameters),
                ];

                return new ReportsAggregatorProxy($repositories, $cacheTimeInMinute);
            }
        );
    }
}
