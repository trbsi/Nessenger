<?php

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Resources\ElasticSearch\Traits\IndexTrait;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Code\Search\Services\Interfaces\IndexDocumentServiceInterface;
use Elasticsearch\ClientBuilder;

class IndexDocumentService implements IndexDocumentServiceInterface
{
    use IndexTrait;

    public function indexDocument(string $indexType, array $body): array
    {
        $indexName = $this->getIndexName($indexType);

        $client = ClientBuilder::create()->build();
        $params = [
            'index' => $indexName,
            'body'  => $body
        ];
        $response = $client->index($params);
        return $response;
    }
}
