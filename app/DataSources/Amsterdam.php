<?php

namespace App\DataSources;

use App\Contracts\DataSourceInterface;
use Carbon\Carbon;

class Amsterdam implements DataSourceInterface
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
        <value>".($this->date->format('d')+0)."</value>
    </prediction>
    <prediction>
        <time>01:00</time>
        <value>".($this->date->format('d')+1)."</value>
    </prediction>
    <prediction>
        <time>02:00</time>
        <value>".($this->date->format('d')+2)."</value>
    </prediction>
    <prediction>
        <time>03:00</time>
        <value>".($this->date->format('d')+3)."</value>
    </prediction>
    <prediction>
        <time>04:00</time>
        <value>".($this->date->format('d')+4)."</value>
    </prediction>
    <prediction>
        <time>05:00</time>
        <value>".($this->date->format('d')+1)."</value>
    </prediction>
    <prediction>
        <time>06:00</time>
        <value>".($this->date->format('d')+2)."</value>
    </prediction>
    <prediction>
        <time>07:00</time>
        <value>".($this->date->format('d')+5)."</value>
    </prediction>
    <prediction>
        <time>08:00</time>
        <value>".($this->date->format('d')+4)."</value>
    </prediction>
    <prediction>
        <time>09:00</time>
        <value>".($this->date->format('d')+9)."</value>
    </prediction>
    <prediction>
        <time>10:00</time>
        <value>".($this->date->format('d')+10)."</value>
    </prediction>
    <!-- more... -->
</predictions>";
    }
}