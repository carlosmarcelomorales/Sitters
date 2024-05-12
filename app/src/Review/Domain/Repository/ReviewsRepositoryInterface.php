<?php

namespace App\Review\Domain\Repository;

use App\Review\Domain\Entity\Reviews\Reviews;

interface ReviewsRepositoryInterface
{
    public function read(): Reviews;
}