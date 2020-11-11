<?php

namespace App\Code\Search\Services\Interfaces;

interface BulkIndexDocumentServiceInterface
{
    public function indexDocuments(array $params): array;
}
