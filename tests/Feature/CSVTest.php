<?php

namespace Tests\Feature;

use App\Services\CSV;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CSVTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_is_the_csv_parser_working_correctly()
    {
        $rawCSVData = 'id,name,lastname,age
1,amir,alian,26';

        $csvToArray = (new CSV($rawCSVData))->toArray();


        $this->assertIsArray($csvToArray);
        $this->arrayHasKey($csvToArray);
        $this->assertEquals('1', $csvToArray[0]['id']);
        $this->assertEquals('amir', $csvToArray[0]['name']);
        $this->assertEquals('alian', $csvToArray[0]['lastname']);
        $this->assertEquals('26', $csvToArray[0]['age']);
    }

    public function test_is_injected_data_to_csv_class_is_null(){

        $this->expectException(\Exception::class);
        $csv = (new CSV(null))->toArray();
    }
}
