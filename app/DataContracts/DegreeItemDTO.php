<?php
namespace App\DataContracts;

use App\Contracts\DegreeInterface;

class DegreeItemDTO
{
    /**
     * @var int
     */
    public $hour;

    /**
     * @var DegreeInterface
     */
    public $degree;
}