<?php

declare(strict_types=1);

namespace App\Code\Search\Services\Interfaces;

interface DeleteByQueryServiceInterface
{
    public function deleteByQuery(string $indexType, array $query): array;
}
