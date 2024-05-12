<?php

namespace App\Sitter\Application\Service;

use App\Rating\Application\Service\CalculateRatingScoreService;
use App\Review\Domain\Entity\Review\Review;
use App\Review\Domain\Entity\Review\Reviews;
use App\Shared\Domain\Sitter\SitterName;
use App\Sitter\Domain\Entity\ProfileScore;
use App\Sitter\Domain\Entity\Rating\Ratings;
use App\Sitter\Domain\Entity\Sitter\Sitter;
use App\Sitter\Domain\Entity\Sitter\Sitters;

class GetSittersScoreService
{
    private const NUM_LETTERS_ENG_ALPHABET = 26;

    private CalculateRatingScoreService $calculateRatingScoreService;

    public function __construct(CalculateRatingScoreService $calculateRatingScoreService)
    {
        $this->calculateRatingScoreService = $calculateRatingScoreService;
    }

    public function __invoke(Reviews $reviews): Sitters
    {
        $sitters = new Sitters();

        $reviews->each(function (Review $review) use ($sitters) {
            if ($sitters->isEmpty()) {
                $sitter = $this->createSitter($review, $review->sitterName());

                $sitters->add($sitter);

            } else {

                $sitter = $this->getSitterIfExists($sitters, $review->sitterName());

                if (empty($sitter)) {

                    $sitter = $this->createSitter($review, $review->sitterName());
                    $sitters->add($sitter);

                } else {
                    $sitter->ratings()->add($review->rating());
                }
            }
        });

        $this->calculateRatingScoreService->__invoke($sitters);

        return $sitters;
    }

    private function getSitterIfExists(Sitters $sitters, SitterName $sitterName): ?Sitter
    {
        $existingSitters =  $sitters->filter(function (Sitter $sitter) use ($sitters, $sitterName) {
            return $sitter->sitterName()->value() == $sitterName->value();
        });

        if (!$existingSitters->isEmpty()) {
            return $existingSitters->first();
        }

        return null;
    }

    private function createSitter(Review $review, SitterName $sitterName): Sitter
    {
        $ratings = new Ratings();
        $ratings->add($review->rating());

        return new Sitter(
            $review->sitterEmail(),
            $sitterName,
            $ratings,
            $this->calculateProfileScore($sitterName)
        );
    }

    private function calculateProfileScore(SitterName $sitterName): ProfileScore
    {
        // Delete non alphabetical chars
        $filteredName = preg_replace(
            "/[^a-zA-Z]+/", "",
            strtolower($sitterName->value()
            )
        );

        // Transform string to array to delete repetitions
        $nameArray = array_unique(str_split($filteredName));

        $numCharacters = count($nameArray);

        $profileScore = 5 * ($numCharacters / self::NUM_LETTERS_ENG_ALPHABET);

        return new ProfileScore(number_format((float) $profileScore, 2));
    }

}