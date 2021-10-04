<?php

namespace App\Interfaces;

interface CityInterface
{
    public function getCities (int $offset, int $limit, string $sort_by);
}