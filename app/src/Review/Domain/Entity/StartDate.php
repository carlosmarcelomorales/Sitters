<?php

namespace App\Review\Domain\Entity;

use DateTime;

class StartDate
{
    private DateTime $startDate;

    public function __construct(DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    public function startDate(): DateTime
    {
        return $this->startDate;
    }
}