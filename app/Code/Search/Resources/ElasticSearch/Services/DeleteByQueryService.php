<?php

declare(strict_types=1);

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Services\Interfaces\DeleteByQueryServiceInterface;
use Elasticsearch\ClientBuilder;

final class DeleteByQueryService implements DeleteByQueryServiceInterface
{
    public function deleteByQuery(string $indexName, array $query): array
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => $indexName,
            'query' => $query,
        ];
        return $client->deleteByQuery($params);
    }
}
