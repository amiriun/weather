<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class AccessabilityTest extends TestCase
{
    /**
     * @return void
     */
    public function test_api_is_working_normally_in_celsius()
    {
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?degree_type=celsius&date='.Carbon::now()->format('Y-m-d'));

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_api_is_working_normally_in_fahrenheit()
    {
        $dateTime = Carbon::now()->format('Y-m-d');
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?degree_type=fahrenheit&date='.$dateTime);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_api_should_not_work_in_invalid_degree_scale()
    {
        $dateTime = Carbon::now()->format('Y-m-d');
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?degree_type=blahblah&date='.$dateTime, ['accept' => 'application/json']);
        $response->assertSee('The selected degree type is invalid');
        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_api_should_not_work_in_invalid_date_format()
    {
        $dateTime = Carbon::now()->format('Y-md');
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?degree_type=celsius&date='.$dateTime, ['accept' => 'application/json']);
        $response->assertSee('The date does not match the format Y-m-d.');
        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_api_should_not_work_in_past_dates()
    {
        $dateTime = Carbon::now()->subDay()->format('Y-m-d');
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?degree_type=celsius&date='.$dateTime, ['accept' => 'application/json']);
        $response->assertSee('The date must be a date after or equal to today.');
        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_api_should_have_been_working_till_next_ten_days()
    {
        $dateTime = Carbon::now()->addDays(10)->format('Y-m-d');
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?degree_type=celsius&date='.$dateTime, ['accept' => 'application/json']);
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_api_should_not_work_for_more_than_ten_days()
    {
        $dateTime = Carbon::now()->addDays(11)->format('Y-m-d');
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?degree_type=celsius&date='.$dateTime, ['accept' => 'application/json']);
        $response->assertSee('The date must be a date before or equal to');
        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_api_degree_type_parameter_is_required()
    {
        $dateTime = Carbon::now()->format('Y-m-d');
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?date='.$dateTime, ['accept' => 'application/json']);
        $response->assertSee('The degree type field is required.');
        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_api_date_parameter_is_required()
    {
        $dateTime = Carbon::now()->format('Y-m-d');
        $response = $this->get('api/v_1_0/en/weather/Amsterdam?degree_type=celsius', ['accept' => 'application/json']);
        $response->assertSee('The date field is required.');
        $response->assertStatus(422);
    }
}
