<?php

namespace App\Review\Domain\Entity\Owner;

class OwnerEmail
{
    private string $ownerEmail;

    public function __construct(string $ownerEmail)
    {
        $this->ownerEmail = $ownerEmail;
    }

    public function ownerEmail(): string
    {
        return $this->ownerEmail;
    }
}