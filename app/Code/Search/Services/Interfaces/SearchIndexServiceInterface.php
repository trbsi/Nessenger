<?php

namespace App\Code\Search\Services\Interfaces;

interface SearchIndexServiceInterface
{
    public function searchIndex(string $indexType, array $query): array;
}
