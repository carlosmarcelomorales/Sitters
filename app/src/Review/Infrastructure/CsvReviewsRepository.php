<?php

namespace App\Review\Infrastructure;

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
use App\Sitter\Domain\Entity\Rating\Rating;
use DateTime;
use Exception;

class CsvReviewsRepository implements ReviewsRepositoryInterface
{
    private const CSV_PATH = 'reviews.csv';

    /**
     * @throws Exception
     */
    public function read(): Reviews
    {
        $file = fopen(self::CSV_PATH, "r");

        if ($file !== false) {
            fgetcsv($file);
            $reviews = new Reviews();
            while (($data = fgetcsv($file)) !== false) {
                $reviews = $this->addReviews($reviews, $data);
            }
            fclose($file);
            return $reviews;
        } else {
            throw new Exception('Unable to read csv file');
        }
    }

    /**
     * @throws Exception
     */
    public function addReviews(Reviews $reviews, $data): Reviews
    {
        $review = $this->createReview($data);
        $reviews->add($review);

        return $reviews;
    }

    /**
     * @throws Exception
     */
    public function createReview($data): Review
    {
        return new Review(
            new Rating((int)$data[0]),
            new SitterImage($data[1]),
            new EndDate(new DateTime($data[2])),
            new Text($data[3]),
            new OwnerImage($data[4]),
            new Dogs($data[5]),
            new SitterName($data[6]),
            new OwnerName($data[7]),
            new StartDate(new DateTime($data[8])),
            new SitterPhoneNumber($data[9]),
            new SitterEmail($data[10]),
            new OwnerPhoneNumber($data[11]),
            new OwnerEmail($data[12]),
            new ResponseTimeMinutes($data[13])
        );
    }

}