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


    public function each(callable $fn): void
    {
        array_walk($this->elements, $fn);
    }

    public function map(callable $fn): array
    {
        return array_map($fn, $this->elements);
    }

    public function filter(callable $fn): static
    {
        return new static(array_filter($this->elements, $fn, ARRAY_FILTER_USE_BOTH));
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }
}