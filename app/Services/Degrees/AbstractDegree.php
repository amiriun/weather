<?php
namespace App\Services\Degrees;

use App\Contracts\DegreeInterface;

abstract class AbstractDegree implements DegreeInterface
{
    protected $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }
}