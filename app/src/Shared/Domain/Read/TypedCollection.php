<?php

declare(strict_types=1);

namespace App\Shared\Domain\Read;

abstract class TypedCollection extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct($elements);
    }

    abstract protected function type(): string;

}