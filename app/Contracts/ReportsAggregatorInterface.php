<?php
namespace App\Contracts;

interface ReportsAggregatorInterface
{
    public function average($degreeType): array;
}