<?php

namespace App\Sitter\Domain\Entity\Sitter;

use App\Shared\Domain\Read\TypedCollection;

class Sitters extends TypedCollection
{
    protected function type(): string
    {
        return Sitter::class;
    }
}