<?php

namespace App\Review\Domain\Entity;

use DateTime;

class EndDate
{
    private DateTime $endDate;

    public function __construct(DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    public function endDate(): DateTime
    {
        return $this->endDate;
    }
}