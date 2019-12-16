<?php

namespace App\Providers;

use App\Contracts\ReportsAggregatorInterface;
use App\Mocks\Amsterdam;
use App\Mocks\BBC;
use App\Mocks\WeatherDotCom;
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
        $this->bindDegreeScales();
        $this->bindAggregatorClass();
        $this->bindRepositories();
        $this->bindReportAggregators();
    }

    private function bindDegreeScales(): void
    {
        $this->app->bind(
            'degree_scale.bbc',
            function ($app, array $parameters = []) {
                return new Fahrenheit($parameters[0]);
            }
        );
        $this->app->bind(
            'degree_scale.weather_dot_com',
            function ($app, array $parameters = []) {
                return new Celsius($parameters[0]);
            }
        );
        $this->app->bind(
            'degree_scale.amsterdam',
            function ($app, array $parameters = []) {
                return new Celsius($parameters[0]);
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
            'repository.bbc',
            function ($app, array $parameters = []) {
                $bbcDataSource = new BBC($parameters[0], $parameters[1]);

                return new BBCRepository($parameters[0], $parameters[1], $bbcDataSource);
            }
        );
        $this->app->bind(
            'repository.weather_dot_com',
            function ($app, array $parameters = []) {
                $weatherDotComDataSource = new WeatherDotCom($parameters[0], $parameters[1]);

                return new WeatherDotComRepository($parameters[0], $parameters[1], $weatherDotComDataSource);
            }
        );
        $this->app->bind(
            'repository.amsterdam',
            function ($app, array $parameters = []) {
                $amsterdamDataSource = new Amsterdam($parameters[0], $parameters[1]);

                return new AmsterdamRepository($parameters[0], $parameters[1], $amsterdamDataSource);
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
                    app('repository.bbc', $parameters),
                    app('repository.weather_dot_com', $parameters),
                    app('repository.amsterdam', $parameters),
                ];

                return new ReportsAggregatorProxy($repositories, $cacheTimeInMinute);
            }
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
