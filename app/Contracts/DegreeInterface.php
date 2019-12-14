<?php
namespace App\Contracts;

interface DegreeInterface
{
    public function toCelsius() : int;

    public function toFahrenheit() : int;
}