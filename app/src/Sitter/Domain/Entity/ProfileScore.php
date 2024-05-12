<?php

namespace App\Sitters\Domain\Entity;

class ProfileScore
{
    private float $profileScore;

    public function __construct(float $profileScore)
    {
        $this->profileScore = $profileScore;
    }

    public function profileScore(): float
    {
        return $this->profileScore;
    }
}