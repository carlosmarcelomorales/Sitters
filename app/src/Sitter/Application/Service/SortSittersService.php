<?php

namespace App\Sitter\Application\Service;

use App\Shared\Domain\Sitter\SitterEmail;
use App\Shared\Domain\Sitter\SitterName;
use App\Sitter\Domain\Entity\ProfileScore;
use App\Sitter\Domain\Entity\Rating\Rating;
use App\Sitter\Domain\Entity\Rating\Ratings;
use App\Sitter\Domain\Entity\RatingsScore;
use App\Sitter\Domain\Entity\SearchScore;
use App\Sitter\Domain\Entity\Sitter\Sitter;
use App\Sitter\Domain\Entity\Sitter\Sitters;

class SortSittersService
{

    public function __invoke(Sitters $sitters): Sitters
    {
        $sittersArray = $sitters->map(fn (Sitter $sitter) => $sitter->toArray());

        uasort($sittersArray, function ($a, $b) {
            if ($a["searchScore"] < $b["searchScore"]) {
                return 1;
            } elseif ($a["searchScore"] > $b["searchScore"]) {
                return -1;
            } else {
                return strcmp($a["sitterName"], $b["sitterName"]);
            }
        });

        return $this->createOrderedSitters($sittersArray);
    }

    public function createOrderedSitters(array $sittersArray): Sitters
    {
        $sortedSitters = new Sitters();

        array_map(function ($sitter) use ($sortedSitters) {
            $ratings = new Ratings();
            $sitter = new Sitter(
                new SitterEmail($sitter["sitterEmail"]),
                new SitterName($sitter["sitterName"]),
                $this->getRatings($sitter, $ratings),
                new ProfileScore($sitter["profileScore"]),
                new RatingsScore($sitter["ratingsScore"]),
                new SearchScore($sitter["searchScore"])
            );
            $sortedSitters->add($sitter);
        }, $sittersArray);

        return $sortedSitters;
    }

    private function getRatings($sitter, Ratings $ratings): Ratings
    {
        array_map(
            fn ($rating) => $ratings->add(new Rating($rating['rating'])),
            $sitter['ratings']
        );

        return $ratings;
    }

}