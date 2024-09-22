<?php

namespace App\Review\Infrastructure\Repository;

use App\Review\Domain\Entity\Review\Reviews;
use App\Review\Domain\Factory\CreateReviewFactory;
use App\Review\Domain\Repository\ReviewsRepositoryInterface;
use Exception;

class CsvReviewsRepository implements ReviewsRepositoryInterface
{
    private const CSV_PATH = 'reviews.csv';
    private CreateReviewFactory $createReviewFactory;

    public function __construct(CreateReviewFactory $createReviewFactory)
    {
        $this->createReviewFactory = $createReviewFactory;
    }
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
        $review = $this->createReviewFactory->createReview($data);
        $reviews->add($review);

        return $reviews;
    }

}