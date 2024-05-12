<?php

namespace App\Review\Domain\Entity\Review;

use App\Shared\Domain\Read\TypedCollection;

class Reviews extends TypedCollection
{
    protected function type(): string
    {
        return Review::class;
    }
}