<?php
namespace App\Contracts;

interface DegreeInterface
{
    public function toCelsius() : float;

    public function toFahrenheit() : float;
}