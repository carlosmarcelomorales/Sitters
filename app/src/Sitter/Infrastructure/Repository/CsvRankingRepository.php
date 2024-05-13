<?php

namespace App\Sitter\Infrastructure\Repository;

use App\Sitter\Domain\Entity\Sitter\Sitter;
use Exception;
use App\Sitter\Domain\Entity\Sitter\Sitters;
use App\Sitter\Domain\Repository\RankingRepositoryInterface;

class CsvRankingRepository implements RankingRepositoryInterface
{
    private const FILENAME = 'sitters.csv';

    public function create(Sitters $sitters): bool
    {
        $file = fopen(self::FILENAME, 'w');

        if ($file === false) {
            throw new Exception('Unable to open file.');
        }

        $headers = ['email', 'name', 'profile_score', 'ratings_score', 'search_score'];

        fputcsv($file, $headers);
        $sittersArray = $sitters->map(fn (Sitter $sitter) => $sitter->toArray());

        foreach ($sittersArray as $sitter) {
            $sitterInfo = [
                'email' => $sitter['sitterEmail'],
                'name' => $sitter['sitterName'],
                'profile_score' => $sitter['profileScore'],
                'ratings_score' => $sitter['ratingsScore'],
                'search_score' => $sitter['searchScore']
            ];
            fputcsv($file, $sitterInfo);
        }

        fclose($file);

        return true;
    }
}