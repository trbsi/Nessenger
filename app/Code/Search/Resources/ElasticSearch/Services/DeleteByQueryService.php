<?php

declare(strict_types=1);

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Resources\ElasticSearch\Traits\IndexTrait;
use App\Code\Search\Services\Interfaces\DeleteByQueryServiceInterface;
use Elasticsearch\ClientBuilder;

final class DeleteByQueryService implements DeleteByQueryServiceInterface
{
    use IndexTrait;

    public function deleteByQuery(string $indexType, array $query): array
    {
        $indexName = $this->getIndexName($indexType);

        $client = ClientBuilder::create()->build();
        $params = [
            'index' => $indexName,
            'body' => $query,
        ];
        return $client->deleteByQuery($params);
    }
}
