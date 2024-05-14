<?php

namespace App\Tests\Service;

use App\Shared\Domain\Sitter\SitterEmail;
use App\Shared\Domain\Sitter\SitterName;
use App\Sitter\Application\Service\SortSittersService;
use App\Sitter\Domain\Entity\ProfileScore;
use App\Sitter\Domain\Entity\Rating\Rating;
use App\Sitter\Domain\Entity\Rating\Ratings;
use App\Sitter\Domain\Entity\RatingsScore;
use App\Sitter\Domain\Entity\SearchScore;
use App\Sitter\Domain\Entity\Sitter\Sitter;
use App\Sitter\Domain\Entity\Sitter\Sitters;
use PHPUnit\Framework\TestCase;

class SortSittersServiceTest extends TestCase
{
    private SortSittersService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new SortSittersService();
    }

    public function testItSortsSittersCorrectly()
    {
        $sitters = new Sitters();
        $sitters->add($this->createSitter('Carlos', 2));
        $sitters->add($this->createSitter('Carla', 2));
        $sitters->add($this->createSitter('Eugenia', 5));

        $sortedSitters = $this->service->__invoke($sitters);

        $expectedSitters = new Sitters();
        $expectedSitters->add($this->createSitter('Eugenia', 5));
        $expectedSitters->add($this->createSitter('Carla', 2));
        $expectedSitters->add($this->createSitter('Carlos', 2));

        $this->assertEquals($expectedSitters, $sortedSitters);
    }

    private function createSitter(string $name, float $searchScore): Sitter
    {
        $ratings = new Ratings();
        $ratings->add(new Rating(5));

        return new Sitter(
            new SitterEmail('test@test.com'),
            new SitterName($name),
            $ratings,
            new ProfileScore('1.15'),
            new RatingsScore('5.00'),
            new SearchScore($searchScore)
        );
    }
}