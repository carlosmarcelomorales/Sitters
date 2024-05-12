<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\ReviewsRepositoryInterface;

class CsvReviewsRepository implements ReviewsRepositoryInterface
{
    private const CSV_PATH = 'reviews.csv';
    public function read(): void
    {
        $file = fopen(self::CSV_PATH, "r");

        if ($file !== false) {

            while (($data = fgetcsv($file)) !== false) {
                print_r($data);
            }

            fclose($file);
        } else {

            throw new \Exception('Unable to read csv file');
        }
    }
}