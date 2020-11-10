<?php

namespace App\Code\Search\Services\Interfaces;

interface SearchIndexServiceInterface
{
    public function searchIndex(string $indexName, array $query): array;
}
