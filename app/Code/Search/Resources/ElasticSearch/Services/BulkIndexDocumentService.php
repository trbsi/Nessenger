<?php

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Resources\ElasticSearch\Factories\ElasticSearchPropertiesFactory;
use App\Code\Search\Services\Interfaces\BulkIndexDocumentServiceInterface;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use Elasticsearch\ClientBuilder;

class BulkIndexDocumentService implements BulkIndexDocumentServiceInterface
{
    public function indexDocuments(array $params): array
    {
        $client = ClientBuilder::create()->build();
        return $client->bulk($params);
    }
}
