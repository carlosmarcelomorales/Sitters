<?php

namespace App\Sitter\Application\Service;

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

    public function __invoke(Reviews $reviews)
    {
        $sitters = new Sitters();
        $reviews->each(function (Review $review) use ($sitters) {
            if ($sitters->isEmpty()) {
                $sitter = $this->createSitter($review, $review->sitterName());

                $sitters->add($sitter);
            } else {

                $sitter = $this->getSitterIfExists($sitters, $review->sitterName());

                if (!empty($sitter)) {
                    // TODO
                }
            }
        });

    }

    private function getSitterIfExists(Sitters $sitters, SitterName $sitterName): Sitters
    {
        return $sitters->filter(function (Sitter $sitter) use ($sitters, $sitterName) {
            return $sitter->sitterName()->value() == $sitterName->value();
        });
    }

    private function createSitter(Review $review, SitterName $sitterName): Sitter
    {
        $ratings = new Ratings();
        dd($review->rating());

        return new Sitter(
            $review->sitterEmail(),
            $sitterName,
            $ratings->add($review->rating()),
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

        return new ProfileScore(5 * ($numCharacters / self::NUM_LETTERS_ENG_ALPHABET));
    }

}