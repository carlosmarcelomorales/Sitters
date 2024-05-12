<?php

namespace App\Sitters\Application\UseCase\RankingSitters;

use App\Review\Domain\Repository\ReviewsRepositoryInterface;
use Exception;

class GenerateRankingSittersUseCase
{
    private ReviewsRepositoryInterface $reviewsRepository;

    public function __construct(ReviewsRepositoryInterface $reviewsRepository) {
        $this->reviewsRepository = $reviewsRepository;
    }

    public function __invoke()
    {
        try {
            $reviews = $this->reviewsRepository->read();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
}