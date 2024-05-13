<?php

namespace App\Sitter\Domain\Repository;

use App\Sitter\Domain\Entity\Sitter\Sitters;

interface RankingRepositoryInterface
{
    public function create(Sitters $sitters): bool;
}