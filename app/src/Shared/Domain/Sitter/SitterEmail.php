<?php

namespace App\Shared\Domain\Sitter;

class SitterEmail
{
    private string $sitterEmail;

    public function __construct(string $sitterEmail)
    {
        $this->sitterEmail = $sitterEmail;
    }

    public function value(): string
    {
        return $this->sitterEmail;
    }
}