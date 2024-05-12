<?php

namespace App\Sitters\Domain\Entity\Sitter;

use App\Shared\Domain\Sitter\SitterEmail;
use App\Shared\Domain\Sitter\SitterName;
use App\Sitters\Domain\Entity\ProfileScore;
use App\Sitters\Domain\Entity\RatingsScore;
use App\Sitters\Domain\Entity\SearchScore;

class Sitter
{
    private SitterEmail $sitterEmail;
    private SitterName $sitterName;
    private ?ProfileScore $profileScore;
    private ?RatingsScore $ratingsScore;
    private ?SearchScore $searchScore;

    public function __construct(
        SitterEmail $sitterEmail,
        SitterName $sitterName,
        ?ProfileScore $profileScore = null,
        ?RatingsScore $ratingsScore = null,
        ?SearchScore $searchScore = null
    )
    {
        $this->sitterEmail = $sitterEmail;
        $this->sitterName = $sitterName;
        $this->profileScore = $profileScore;
        $this->ratingsScore = $ratingsScore;
        $this->searchScore = $searchScore;
    }

    public function sitterName(): SitterName
    {
        return $this->sitterName;
    }

}