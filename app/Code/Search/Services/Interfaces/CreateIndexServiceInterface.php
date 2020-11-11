<?php

namespace App\Code\Search\Services\Interfaces;

interface CreateIndexServiceInterface
{
    public function createIndex(string $indexName): array;
}
