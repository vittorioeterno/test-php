<?php

namespace App\Interfaces;

interface CityInterface
{
    /**
     * @return array<mixed> $items
     */
    public function getCities (int $offset, int $limit, string $sort_by) : ?array;
}