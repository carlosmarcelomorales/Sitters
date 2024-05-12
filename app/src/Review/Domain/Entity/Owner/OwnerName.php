<?php

namespace App\Review\Domain\Entity\Owner;

class OwnerName
{
    private string $ownerName;

    public function __construct(string $ownerName)
    {
        $this->ownerName = $ownerName;
    }

    public function ownerName(): string
    {
        return $this->ownerName;
    }

}