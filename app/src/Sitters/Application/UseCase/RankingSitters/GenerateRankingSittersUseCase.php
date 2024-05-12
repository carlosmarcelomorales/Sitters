<?php

namespace App\Sitters\Application\UseCase\RankingSitters;

use App\Review\Domain\Entity\Review\Reviews;
use App\Review\Domain\Repository\ReviewsRepositoryInterface;
use App\Sitters\Application\Service\GetSittersScoreService;
use Exception;

class GenerateRankingSittersUseCase
{
    private ReviewsRepositoryInterface $reviewsRepository;
    private GetSittersScoreService  $getSittersScoreService;

    public function __construct(
        ReviewsRepositoryInterface $reviewsRepository,
        GetSittersScoreService $getSittersScoreService
    ) {
        $this->reviewsRepository = $reviewsRepository;
        $this->getSittersScoreService = $getSittersScoreService;
    }

    public function __invoke()
    {
        $reviews = $this->getReviews();
        $this->getSittersScoreService->__invoke($reviews);
    }


    public function getReviews(): Reviews
    {
        try {
            return $reviews = $this->reviewsRepository->read();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}