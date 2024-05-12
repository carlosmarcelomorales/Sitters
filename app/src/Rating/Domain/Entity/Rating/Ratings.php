<?php

namespace App\Sitter\Domain\Entity\Rating;

use App\Shared\Domain\Read\TypedCollection;

class Ratings extends TypedCollection
{
    protected function type(): string
    {
        return Rating::class;
    }
}