<?php

namespace App\Review\Domain\Entity;

class Text
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function text(): string
    {
        return $this->value;
    }
}