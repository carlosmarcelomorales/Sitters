<?php

namespace App\Shared\Domain\Sitter;

class SitterName
{
    private string $sitterName;

    public function __construct(string $sitterName)
    {
        $this->sitterName = $sitterName;
    }

    public function value(): string
    {
        return $this->sitterName;
    }
}