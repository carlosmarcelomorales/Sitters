<?php

namespace App\Review\Domain\Entity\Owner;

class OwnerPhoneNumber
{
    private string $ownerPhoneNumber;

    public function __construct(string $ownerPhoneNumber)
    {
        $this->ownerPhoneNumber = $ownerPhoneNumber;
    }

    public function ownerPhoneNumber(): string
    {
        return $this->ownerPhoneNumber;
    }
}