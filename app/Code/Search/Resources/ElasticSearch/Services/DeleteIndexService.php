<?php

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Resources\ElasticSearch\Traits\IndexTrait;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Code\Search\Services\Interfaces\DeleteIndexServiceInterface;
use Elasticsearch\ClientBuilder;

class DeleteIndexService implements DeleteIndexServiceInterface
{
    use IndexTrait;

    public function deleteIndex(string $indexType): array
    {
        $indexName = $this->getIndexName($indexType);

        $client = ClientBuilder::create()->build();
        $params = ['index' => $indexName];
        $response = $client->indices()->delete($params);
        return $response;
    }
}
