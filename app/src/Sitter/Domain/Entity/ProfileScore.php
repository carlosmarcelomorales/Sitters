<?php

namespace App\Sitter\Domain\Entity;

class ProfileScore
{
    private string $profileScore;

    public function __construct(string $profileScore)
    {
        $this->profileScore = number_format((float) $profileScore, 2, '.', '');;
    }

    public function profileScore(): string
    {
        return $this->profileScore;
    }
}