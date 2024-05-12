<?php

namespace App\Review\Domain\Entity\Sitter;

class SitterEmail
{
    private string $sitterEmail;

    public function __construct(string $sitterEmail)
    {
        $this->sitterEmail = $sitterEmail;
    }

    public function sitterEmail(): string
    {
        return $this->sitterEmail;
    }
}