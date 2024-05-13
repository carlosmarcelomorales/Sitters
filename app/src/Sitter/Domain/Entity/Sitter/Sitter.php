<?php

namespace App\Sitter\Domain\Entity\Sitter;

use App\Shared\Domain\Sitter\SitterEmail;
use App\Shared\Domain\Sitter\SitterName;
use App\Sitter\Domain\Entity\ProfileScore;
use App\Sitter\Domain\Entity\Rating\Rating;
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

    public function profileScore(): ProfileScore
    {
        return $this->profileScore;
    }

    public function searchScore(): SearchScore
    {
        return $this->searchScore;
    }

    public function ratings(): Ratings
    {
        return $this->ratings;
    }

    public function withScores(RatingsScore $ratingsScore, SearchScore $searchScore): Sitter
    {
        return new Sitter(
            $this->sitterEmail,
            $this->sitterName,
            $this->ratings,
            $this->profileScore,
            $ratingsScore,
            $searchScore
        );
    }

    public function toArray(): array
    {
        return [
            'sitterEmail' => $this->sitterEmail->value(),
            'sitterName' => $this->sitterName->value(),
            'ratings' => $this->ratings->map(fn (Rating $rating) => $rating->toArray()),
            'profileScore' => $this->profileScore->value(),
            'ratingsScore' => $this->ratingsScore->value(),
            'searchScore' => $this->searchScore->value(),
        ];
    }

}