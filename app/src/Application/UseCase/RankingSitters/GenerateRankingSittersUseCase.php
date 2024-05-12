<?php

namespace App\Application\UseCase\RankingSitters;

use App\Domain\Repository\ReviewsRepositoryInterface;

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