<?php

namespace App\Sitter\Domain\Entity\Rating;

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

    public function toArray(): array
    {
        return [
            'rating' => $this->rating,
        ];
    }
}