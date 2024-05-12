<?php

namespace App\Review\Domain\Entity\Reviews;

use App\Shared\Domain\Read\TypedCollection;

class Reviews extends TypedCollection
{
    protected function type(): string
    {
        return Review::class;
    }
}