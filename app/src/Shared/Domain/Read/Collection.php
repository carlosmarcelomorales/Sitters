<?php

declare(strict_types=1);

namespace App\Shared\Domain\Read;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

abstract class Collection implements IteratorAggregate
{
    public function __construct(private array $elements)
    {}

    public function add(mixed $element): void
    {
        $this->elements[] = $element;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }
}