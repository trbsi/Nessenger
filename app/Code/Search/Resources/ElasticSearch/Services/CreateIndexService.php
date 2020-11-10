<?php

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Resources\ElasticSearch\Factories\ElasticSearchPropertiesFactory;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use Elasticsearch\ClientBuilder;

class CreateIndexService implements CreateIndexServiceInterface
{
    private ElasticSearchPropertiesFactory $elasticSearchPropertiesFactory;

    public function __construct(
        ElasticSearchPropertiesFactory $elasticSearchPropertiesFactory
    ) {
        $this->elasticSearchPropertiesFactory = $elasticSearchPropertiesFactory;
    }

    public function createIndex(string $indexName): array
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => $indexName,
            'body' => [
                'settings' => [
                    'number_of_shards' => 3,
                    'number_of_replicas' => 1
                ],
                'mappings' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => $this->elasticSearchPropertiesFactory->getPropertiesByIndexName($indexName),
                ]
            ]
        ];


        return $client->indices()->create($params);
    }
}
