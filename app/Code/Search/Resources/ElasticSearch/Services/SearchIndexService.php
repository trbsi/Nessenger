<?php

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Resources\ElasticSearch\Traits\IndexTrait;
use App\Code\Search\Services\Interfaces\SearchIndexServiceInterface;
use Elasticsearch\ClientBuilder;

class SearchIndexService implements SearchIndexServiceInterface
{
    use IndexTrait;

    public function searchIndex(string $indexType, array $body): array
    {
        $indexName = $this->getIndexName($indexType);

        $client = ClientBuilder::create()->build();
        $params = [
            'index' => $indexName,
            'body'  => $body
        ];

        $results = $client->search($params);

        return $results['hits']['hits'];
    }
}
