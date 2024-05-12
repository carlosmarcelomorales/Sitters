<?php

namespace App\Review\Domain\Entity\Sitter;

class SitterImage
{
    private string $sitterImage;

    public function __construct(string $sitterImage)
    {
        $this->sitterImage = $sitterImage;
    }

    public function sitterImage(): string
    {
        return $this->sitterImage;
    }

}