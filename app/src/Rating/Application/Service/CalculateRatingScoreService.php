<?php

namespace App\Rating\Application\Service;

use App\Rating\Domain\Entity\Rating\Rating;
use App\Sitter\Domain\Entity\RatingsScore;
use App\Sitter\Domain\Entity\Sitter\Sitter;
use App\Sitter\Domain\Entity\Sitter\Sitters;

class CalculateRatingScoreService
{

    public function __invoke(Sitters $sitters): Sitters
    {
        $updatedSitters = new Sitters();

        $sitters->each(function (Sitter $sitter) use ($updatedSitters) {
            $ratingScore = $this->calculateRatingScore($sitter);
            $updatedSitters->add($sitter->withRatingScore($ratingScore));
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
}