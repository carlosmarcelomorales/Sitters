<?php

namespace App\Tests\Service;

use App\Review\Domain\Entity\Dogs;
use App\Review\Domain\Entity\EndDate;
use App\Review\Domain\Entity\Owner\OwnerEmail;
use App\Review\Domain\Entity\Owner\OwnerImage;
use App\Review\Domain\Entity\Owner\OwnerName;
use App\Review\Domain\Entity\Owner\OwnerPhoneNumber;
use App\Review\Domain\Entity\ResponseTimeMinutes;
use App\Review\Domain\Entity\Review\Review;
use App\Review\Domain\Entity\Review\Reviews;
use App\Review\Domain\Entity\Sitter\SitterImage;
use App\Review\Domain\Entity\Sitter\SitterPhoneNumber;
use App\Review\Domain\Entity\StartDate;
use App\Review\Domain\Entity\Text;
use App\Shared\Domain\Sitter\SitterEmail;
use App\Shared\Domain\Sitter\SitterName;
use App\Sitter\Application\Service\CalculateScoresService;
use App\Sitter\Application\Service\GetSittersScoreService;
use App\Sitter\Domain\Entity\ProfileScore;
use App\Sitter\Domain\Entity\Rating\Rating;
use App\Sitter\Domain\Entity\Rating\Ratings;
use App\Sitter\Domain\Entity\RatingsScore;
use App\Sitter\Domain\Entity\SearchScore;
use App\Sitter\Domain\Entity\Sitter\Sitter;
use App\Sitter\Domain\Entity\Sitter\Sitters;
use PHPUnit\Framework\TestCase;
use DateTime;

class GetSittersScoreServiceTest extends TestCase
{

    private GetSittersScoreService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new GetSittersScoreService(
            new CalculateScoresService()
        );
    }

    public function testCalculateCorrectScore()
    {
        $sitters = new Sitters();
        $sitters->add($this->createSitter());

        $result = $this->service->__invoke($this->createReviews());

        $this->assertEquals($result, $sitters);
    }

    private function createReviews(): Reviews
    {
        $reviews = new Reviews();
        $reviews->add(
            new Review(
                new Rating(5),
                new SitterImage('https://sitterimage.com'),
                new EndDate(new DateTime('2024-05-05')),
                new Text('Test'),
                new OwnerImage('https://ownerimage.com'),
                new Dogs('Pipo'),
                new SitterName('Carlos'),
                new OwnerName('Test'),
                new StartDate(new \DateTime('2024-05-04')),
                new SitterPhoneNumber('66555444'),
                new SitterEmail('test@test.com'),
                new OwnerPhoneNumber('666444555'),
                new OwnerEmail('owner@test.com'),
                new ResponseTimeMinutes('5')
            )
        );

        return $reviews;
    }

    private function createSitter(): Sitter
    {
        $ratings = new Ratings();
        $ratings->add(new Rating(5));

        return new Sitter(
            new SitterEmail('test@test.com'),
            new SitterName('Carlos'),
            $ratings,
            new ProfileScore('1.15'),
            new RatingsScore('5.00'),
            new SearchScore('1.40')
        );
    }
}