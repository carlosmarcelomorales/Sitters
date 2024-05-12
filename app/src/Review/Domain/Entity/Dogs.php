<?php

namespace App\Review\Domain\Entity;

class Dogs
{
    private string $dogs;

    public function __construct(string $dogs)
    {
        $this->dogs = $dogs;
    }

    public function dogs(): string
    {
        return $this->dogs;
    }
}