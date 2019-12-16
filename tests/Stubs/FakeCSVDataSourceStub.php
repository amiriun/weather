<?php
/**
 * Created by PhpStorm.
 * User: amir
 * Date: 12/17/19
 * Time: 12:48 AM
 */

namespace Tests\Stubs;

use App\Contracts\DataSourceInterface;
use Carbon\Carbon;

class FakeCSVDataSourceStub implements DataSourceInterface
{
    private $date;

    private $city;

    public function __construct(string $city, Carbon $date)
    {
        $this->date = $date;
        $this->city = $city;
    }

    public function serveRawData()
    {
        return '"-scale","city","date","prediction__time","prediction__value"
"celsius","Amsterdam","20180112","00:00","05"
"","","","01:00","05"
"","","","02:00","06"
"","","","03:00","05"
"","","","04:00","08"
"","","","05:00","05"
"","","","06:00","15"
"","","","07:00","00"
"","","","08:00","01"
"","","","09:00","02"
"","","","10:00","03"
';
    }
}