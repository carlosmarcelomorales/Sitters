<?php

namespace App\Review\Domain\Entity;

class ResponseTimeMinutes
{
    private int $responseTimeMinutes;

    public function __construct(int $responseTimeMinutes)
    {
        $this->responseTimeMinutes = $responseTimeMinutes;
    }

    public function responseTimeMinutes(): int
    {
        return $this->responseTimeMinutes;
    }
}