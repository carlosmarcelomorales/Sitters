<?php

namespace App\Review\Domain\Entity\Owner;

class OwnerImage
{
    private string $ownerImage;

    public function __construct(string $ownerImage)
    {
        $this->ownerImage = $ownerImage;
    }

    public function ownerImage(): string
    {
        return $this->ownerImage;
    }
}