<?php

namespace App\Review\Domain\Repository;

use App\Review\Domain\Entity\Review\Reviews;

interface ReviewsRepositoryInterface
{
    public function read(): Reviews;
}