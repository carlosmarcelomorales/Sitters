<?php

namespace App\Sitter\Domain\Entity;

class SearchScore
{
    private float $searchScore;

    public function __construct(float $searchScore)
    {
        $this->searchScore = $searchScore;
    }

    public function searchScore(): float
    {
        return $this->searchScore;
    }
}