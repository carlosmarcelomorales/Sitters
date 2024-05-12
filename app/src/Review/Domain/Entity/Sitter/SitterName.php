<?php

namespace App\Review\Domain\Entity\Sitter;

class SitterName
{
    private string $sitterName;

    public function __construct(string $sitterName)
    {
        $this->sitterName = $sitterName;
    }

    public function sitterName(): string
    {
        return $this->sitterName;
    }
}