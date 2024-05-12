<?php

namespace App\Sitter\Domain\Entity\Sitter;

use App\Shared\Domain\Sitter\SitterEmail;
use App\Shared\Domain\Sitter\SitterName;
use App\Sitter\Domain\Entity\ProfileScore;
use App\Sitter\Domain\Entity\Rating\Ratings;
use App\Sitter\Domain\Entity\RatingsScore;
use App\Sitter\Domain\Entity\SearchScore;

class Sitter
{
    private SitterEmail $sitterEmail;
    private SitterName $sitterName;
    private Ratings $ratings;
    private ?ProfileScore $profileScore;
    private ?RatingsScore $ratingsScore;
    private ?SearchScore $searchScore;

    public function __construct(
        SitterEmail $sitterEmail,
        SitterName $sitterName,
        Ratings $ratings,
        ?ProfileScore $profileScore = null,
        ?RatingsScore $ratingsScore = null,
        ?SearchScore $searchScore = null
    )
    {
        $this->sitterEmail = $sitterEmail;
        $this->sitterName = $sitterName;
        $this->ratings = $ratings;
        $this->profileScore = $profileScore;
        $this->ratingsScore = $ratingsScore;
        $this->searchScore = $searchScore;
    }

    public function sitterName(): SitterName
    {
        return $this->sitterName;
    }

}