<?php

namespace App\Mocks;

use App\Contracts\MockDataSourceInterface;
use Carbon\Carbon;

class AmsterdamMock implements MockDataSourceInterface
{
    private $date;

    private $city;

    public function __construct(string $city, Carbon $date)
    {
        $this->date = $date;
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function serveRawData()
    {
        return $this->getRawData();
    }

    /**
     * @return string
     */
    private function getRawData()
    {
        return "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<predictions scale=\"celsius\">
    <city>{$this->city}</city>
    <date>{$this->date->format('Ymd')}</date>
    <prediction>
        <time>00:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>01:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>02:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>03:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>04:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>05:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>06:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>07:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>08:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>09:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <prediction>
        <time>10:00</time>
        <value>".rand(0,5)."</value>
    </prediction>
    <!-- more... -->
</predictions>";
    }
}