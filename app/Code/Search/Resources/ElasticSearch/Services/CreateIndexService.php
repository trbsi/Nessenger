<?php

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Resources\ElasticSearch\Factories\ElasticSearchPropertiesFactory;
use App\Code\Search\Resources\ElasticSearch\Traits\IndexTrait;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Models\Index;
use Elasticsearch\ClientBuilder;

class CreateIndexService implements CreateIndexServiceInterface
{
    use IndexTrait;

    private ElasticSearchPropertiesFactory $elasticSearchPropertiesFactory;

    public function __construct(
        ElasticSearchPropertiesFactory $elasticSearchPropertiesFactory
    ) {
        $this->elasticSearchPropertiesFactory = $elasticSearchPropertiesFactory;
    }

    public function createIndex(
        string $indexType,
        ?string $indexName = null,
        bool $createAlias = false
    ): array {
        if (null === $indexName) {
            $indexName = $this->getIndexName($indexType);
        }

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
                    'properties' => $this->elasticSearchPropertiesFactory->getPropertiesByIndexType($indexType),
                ]
            ]
        ];

        $responses[] = $client->indices()->create($params);

        //add alias
        if ($createAlias) {
            $responses[] = $this->createAliasForIndex($indexName);
        }

        return $responses;
    }

    /**
     * @TODO finish this. Need to add support for aliases. Not neccessary for now
     */
    public function createAliasForIndex(string $indexName): array
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'body' => [
                'actions' => [
                    [
                        'add' => [
                            'index' => $indexName,
                            'alias' => '@TODO Create some alias method fetcher'
                        ]
                    ]
                ]
            ]
        ];
        return $client->indices()->updateAliases($params);
    }
}
