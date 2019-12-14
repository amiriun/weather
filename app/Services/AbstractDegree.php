<?php
namespace App\Services;

abstract class AbstractDegree
{
    protected $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }
}