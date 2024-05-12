<?php

namespace App\Review\Domain\Entity\Sitter;

class SitterPhoneNumber
{
    private string $sitterPhoneNumber;

    public function __construct(string $sitterPhoneNumber)
    {
        $this->sitterPhoneNumber = $sitterPhoneNumber;
    }

    public function sitterPhoneNumber(): string
    {
        return $this->sitterPhoneNumber;
    }
}