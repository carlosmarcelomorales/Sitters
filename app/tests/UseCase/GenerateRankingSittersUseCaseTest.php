<?php

namespace App\Tests\UseCase;

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
use App\Review\Domain\Repository\ReviewsRepositoryInterface;
use App\Shared\Domain\Sitter\SitterEmail;
use App\Shared\Domain\Sitter\SitterName;
use App\Sitter\Application\Service\GetSittersScoreService;
use App\Sitter\Application\Service\SortSittersService;
use App\Sitter\Application\UseCase\RankingSitters\GenerateRankingSittersUseCase;
use App\Sitter\Domain\Entity\Rating\Rating;
use App\Sitter\Domain\Repository\RankingRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Exception;
use DateTime;

class GenerateRankingSittersUseCaseTest extends TestCase
{

    private GenerateRankingSittersUseCase $useCase;
    private array $mocks;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mocks[ReviewsRepositoryInterface::class] = $this->createMock(ReviewsRepositoryInterface::class);
        $this->mocks[RankingRepositoryInterface::class] = $this->createMock(RankingRepositoryInterface::class);
        $this->mocks[GetSittersScoreService::class]     = $this->createMock(GetSittersScoreService::class);
        $this->mocks[SortSittersService::class]         = $this->createMock(SortSittersService::class);

        $this->useCase = new GenerateRankingSittersUseCase(
            $this->mocks[ReviewsRepositoryInterface::class],
            $this->mocks[RankingRepositoryInterface::class],
            $this->mocks[GetSittersScoreService::class],
            $this->mocks[SortSittersService::class]
        );
    }

    public function testAllFlowShouldWork()
    {
        $this->mocks[ReviewsRepositoryInterface::class]
            ->expects($this->once())
            ->method('read')
            ->willReturn($this->createReviews());

        $this->mocks[RankingRepositoryInterface::class]
            ->expects($this->once())
            ->method('create')
            ->willReturn(true);

        $result = $this->useCase->__invoke();

        $this->assertTrue($result);

    }

    public function testItShouldReturnExceptionWhenReadingReviewsFile()
    {
        $this->mocks[ReviewsRepositoryInterface::class]
            ->expects($this->once())
            ->method('read')
            ->willThrowException(new Exception());

        $this->expectException(Exception::class);
        $this->useCase->__invoke();
    }

    public function testItShouldReturnExceptionWhenCreatingNewFileRanking()
    {
        $this->mocks[ReviewsRepositoryInterface::class]
            ->expects($this->once())
            ->method('read')
            ->willReturn($this->createReviews());

        $this->mocks[RankingRepositoryInterface::class]
            ->expects($this->once())
            ->method('create')
            ->willThrowException(new Exception('Unable to open file.'));

        $result = $this->useCase->__invoke();
        $this->assertFalse($result);
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
                new StartDate(new DateTime('2024-05-04')),
                new SitterPhoneNumber('66555444'),
                new SitterEmail('test@test.com'),
                new OwnerPhoneNumber('666444555'),
                new OwnerEmail('owner@test.com'),
                new ResponseTimeMinutes('5')
            )
        );
        return $reviews;
    }

}