<?php

namespace App\Sitter\Application\Service;

use App\Sitter\Domain\Entity\Sitter\Sitter;
use App\Sitter\Domain\Entity\Sitter\Sitters;

class SortSittersService
{

    public function __invoke(Sitters $sitters)
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

        dd($sittersArray);

    }

}