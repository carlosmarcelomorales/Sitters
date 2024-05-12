<?php

namespace App\Sitter\Domain\Entity;

class RatingsScore
{
    private string $ratingsScore;

    public function __construct(string $ratingsScore)
    {
        $this->ratingsScore = number_format((float) $ratingsScore, 2, '.', '');
    }

    public function value(): string
    {
        return $this->ratingsScore;
    }
}