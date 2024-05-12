<?php

namespace App\Review\Application\UseCase\RankingSitters;

use App\Review\Domain\Repository\ReviewsRepositoryInterface;

class GenerateRankingSittersUseCase
{
    private ReviewsRepositoryInterface $reviewsRepository;

    public function __construct(ReviewsRepositoryInterface $reviewsRepository) {
        $this->reviewsRepository = $reviewsRepository;
    }

    public function __invoke()
    {
        $this->reviewsRepository->read();
    }
}