<?php

namespace App\Review\Domain\Entity\Reviews;

use App\Review\Domain\Entity\Dogs;
use App\Review\Domain\Entity\EndDate;
use App\Review\Domain\Entity\Owner\OwnerEmail;
use App\Review\Domain\Entity\Owner\OwnerName;
use App\Review\Domain\Entity\Owner\OwnerImage;
use App\Review\Domain\Entity\Owner\OwnerPhoneNumber;
use App\Review\Domain\Entity\Rating;
use App\Review\Domain\Entity\ResponseTimeMinutes;
use App\Review\Domain\Entity\Sitter\SitterEmail;
use App\Review\Domain\Entity\Sitter\SitterImage;
use App\Review\Domain\Entity\Sitter\SitterName;
use App\Review\Domain\Entity\Sitter\SitterPhoneNumber;
use App\Review\Domain\Entity\StartDate;
use App\Review\Domain\Entity\Text;

class Review
{
    private Rating $rating;
    private SitterImage $sitterImage;
    private EndDate $endDate;
    private Text $text;
    private OwnerImage $ownerImage;
    private Dogs $dogs;
    private SitterName $sitter;
    private OwnerName $owner;
    private StartDate $startDate;
    private SitterPhoneNumber $sitterPhoneNumber;
    private SitterEmail $sitterEmail;
    private OwnerPhoneNumber $ownerPhoneNumber;
    private OwnerEmail $ownerEmail;
    private ResponseTimeMinutes $responseTimeMinutes;

    public function __construct(
        Rating                  $rating,
        SitterImage             $sitterImage,
        EndDate                 $endDate,
        Text                    $text,
        OwnerImage              $ownerImage,
        Dogs                    $dogs,
        SitterName              $sitter,
        OwnerName               $owner,
        StartDate               $startDate,
        SitterPhoneNumber       $sitterPhoneNumber,
        SitterEmail             $sitterEmail,
        OwnerPhoneNumber        $ownerPhoneNumber,
        OwnerEmail              $ownerEmail,
        ResponseTimeMinutes     $responseTimeMinutes
    ) {
        $this->rating = $rating;
        $this->sitterImage = $sitterImage;
        $this->endDate = $endDate;
        $this->text = $text;
        $this->ownerImage = $ownerImage;
        $this->dogs = $dogs;
        $this->sitter = $sitter;
        $this->owner = $owner;
        $this->startDate = $startDate;
        $this->sitterPhoneNumber = $sitterPhoneNumber;
        $this->sitterEmail = $sitterEmail;
        $this->ownerPhoneNumber = $ownerPhoneNumber;
        $this->ownerEmail = $ownerEmail;
        $this->responseTimeMinutes = $responseTimeMinutes;
    }

}