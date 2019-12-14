<?php
namespace App\Services\Degrees;

abstract class AbstractDegree
{
    protected $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }
}