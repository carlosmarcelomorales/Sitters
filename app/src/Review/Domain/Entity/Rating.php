<?php

namespace App\Review\Domain\Entity;

class Rating
{
    private int $rating;

    public function __construct(int $rating)
    {
        $this->rating = $rating;
    }

    public function rating(): int
    {
        return $this->rating;
    }
}