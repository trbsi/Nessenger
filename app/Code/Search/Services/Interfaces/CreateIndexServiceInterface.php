<?php

namespace App\Code\Search\Services\Interfaces;

interface CreateIndexServiceInterface
{
    public function createIndex(
        string $indexType,
        ?string $indexName = null,
        bool $createAlias = false
    ): array;
}
