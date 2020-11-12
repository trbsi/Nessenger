<?php

namespace App\Code\Search\Services\Interfaces;

interface IndexDocumentServiceInterface
{
    public function indexDocument(string $indexType, array $data): array;
}
