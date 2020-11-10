<?php

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Code\Search\Services\Interfaces\DeleteIndexServiceInterface;
use Elasticsearch\ClientBuilder;

class DeleteIndexService implements DeleteIndexServiceInterface
{
    public function deleteIndex(string $indexName): array
    {
        $client = ClientBuilder::create()->build();
        $params = ['index' => $indexName];
        $response = $client->indices()->delete($params);
        return $response;
    }
}
