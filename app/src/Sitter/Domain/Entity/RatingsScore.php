<?php

namespace App\Sitters\Domain\Entity;

class RatingsScore
{
    private float $ratingsScore;

    public function __construct(float $ratingsScore)
    {
        $this->ratingsScore = $ratingsScore;
    }

    public function ratingsScore(): float
    {
        return $this->ratingsScore;
    }
}