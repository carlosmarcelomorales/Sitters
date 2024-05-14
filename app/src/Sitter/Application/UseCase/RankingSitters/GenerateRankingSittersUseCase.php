<?php

namespace App\Sitter\Application\UseCase\RankingSitters;

use App\Review\Domain\Entity\Review\Reviews;
use App\Review\Domain\Repository\ReviewsRepositoryInterface;
use App\Sitter\Application\Service\GetSittersScoreService;
use App\Sitter\Application\Service\SortSittersService;
use App\Sitter\Domain\Repository\RankingRepositoryInterface;
use Exception;

class GenerateRankingSittersUseCase
{
    private ReviewsRepositoryInterface $reviewsRepository;
    private RankingRepositoryInterface $rankingRepository;
    private GetSittersScoreService  $getSittersScoreService;
    private SortSittersService $sortSittersService;

    public function __construct(
        ReviewsRepositoryInterface $reviewsRepository,
        RankingRepositoryInterface $rankingRepository,
        GetSittersScoreService $getSittersScoreService,
        SortSittersService $sortSittersService

    ) {
        $this->reviewsRepository = $reviewsRepository;
        $this->rankingRepository = $rankingRepository;
        $this->getSittersScoreService = $getSittersScoreService;
        $this->sortSittersService = $sortSittersService;
    }

    public function __invoke(): bool
    {
        $reviews = $this->getReviews();
        $sitters = $this->sortSittersService->__invoke(
            $this->getSittersScoreService->__invoke($reviews)
        );

        try {
            return $this->rankingRepository->create($sitters);
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function getReviews(): Reviews
    {
        try {
            return $this->reviewsRepository->read();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}