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

class FakeXMLDataSourceStub implements DataSourceInterface
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
        return "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<predictions scale=\"celsius\">
    <city>{$this->city}</city>
    <date>{$this->date->format('Ymd')}</date>
    <prediction>
        <time>00:00</time>
        <value>10</value>
    </prediction>
    <prediction>
        <time>01:00</time>
        <value>9</value>
    </prediction>
    <prediction>
        <time>02:00</time>
        <value>8</value>
    </prediction>
    <prediction>
        <time>03:00</time>
        <value>7</value>
    </prediction>
    <prediction>
        <time>04:00</time>
        <value>6</value>
    </prediction>
    <prediction>
        <time>05:00</time>
        <value>13</value>
    </prediction>
    <prediction>
        <time>06:00</time>
        <value>16</value>
    </prediction>
    <prediction>
        <time>07:00</time>
        <value>5</value>
    </prediction>
    <prediction>
        <time>08:00</time>
        <value>1</value>
    </prediction>
    <prediction>
        <time>09:00</time>
        <value>3</value>
    </prediction>
    <prediction>
        <time>10:00</time>
        <value>6</value>
    </prediction>
    <!-- more... -->
</predictions>";
    }
}