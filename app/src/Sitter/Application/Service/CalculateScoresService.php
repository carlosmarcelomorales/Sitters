<?php

namespace App\Sitter\Application\Service;

use App\Sitter\Domain\Entity\Rating\Rating;
use App\Sitter\Domain\Entity\RatingsScore;
use App\Sitter\Domain\Entity\SearchScore;
use App\Sitter\Domain\Entity\Sitter\Sitter;
use App\Sitter\Domain\Entity\Sitter\Sitters;

class CalculateScoresService
{

    public function __invoke(Sitters $sitters): Sitters
    {
        $updatedSitters = new Sitters();

        $sitters->each(function (Sitter $sitter) use ($updatedSitters) {
            $ratingScore = $this->calculateRatingScore($sitter);
            $searchScore = $this->calculateSearchScore($sitter, $ratingScore);

            $updatedSitters->add($sitter->withScores($ratingScore, $searchScore));
        });

        return $updatedSitters;
    }

    private function calculateRatingScore(Sitter $sitter): RatingsScore
    {
        $counter = 0;
        $ratingsSum = 0;

        $sitter->ratings()->each(function (Rating $rating) use (&$ratingsSum, &$counter) {
            $ratingsSum += $rating->rating();
            $counter++;
        });

        return new RatingsScore($ratingsSum / $counter);
    }

    private function calculateSearchScore(Sitter $sitter, RatingsScore $ratingScore): SearchScore
    {
        $count = $sitter->ratings()->count();

        switch ($count) {
            case 0:
                $result = $sitter->profileScore()->value();
                break;
            case $count >= 1 && $count < 10:
                $result = $this->calculateWeightedAverage(
                    $sitter->profileScore()->value(),
                    $count
                );
                break;
            case $count >= 10:
                $result = $ratingScore->value();
                break;
        }

        return new SearchScore($result);
    }

    private function calculateWeightedAverage(
        string $profileScore,
        int $totalRatings
    ): float
    {
        $weightRating = 0.25;

        return (float) $profileScore + ($totalRatings * $weightRating);
    }
}