<?php

namespace App\Sitter\Application\UseCase\RankingSitters;

use App\Review\Domain\Entity\Review\Reviews;
use App\Review\Domain\Repository\ReviewsRepositoryInterface;
use App\Sitter\Application\Service\GetSittersScoreService;
use App\Sitter\Application\Service\SortSittersService;
use App\Sitter\Domain\Entity\Sitter\Sitters;
use Exception;

class GenerateRankingSittersUseCase
{
    private ReviewsRepositoryInterface $reviewsRepository;
    private GetSittersScoreService  $getSittersScoreService;
    private SortSittersService $sortSittersService;

    public function __construct(
        ReviewsRepositoryInterface $reviewsRepository,
        GetSittersScoreService $getSittersScoreService,
        SortSittersService $sortSittersService

    ) {
        $this->reviewsRepository = $reviewsRepository;
        $this->getSittersScoreService = $getSittersScoreService;
        $this->sortSittersService = $sortSittersService;
    }

    public function __invoke(): Sitters
    {
        $reviews = $this->getReviews();
        $sitters = $this->sortSittersService->__invoke(
            $this->getSittersScoreService->__invoke($reviews)
        );

    }


    private function getReviews(): Reviews
    {
        try {
            return $this->reviewsRepository->read();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}