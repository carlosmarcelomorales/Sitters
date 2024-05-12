<?php

namespace App\Sitter\Domain\Entity;

class SearchScore
{
    private string $searchScore;

    public function __construct(float $searchScore)
    {
        $this->searchScore = number_format((string) $searchScore, 2, '.', '');;;
    }

    public function value(): string
    {
        return $this->searchScore;
    }
}