<?php

namespace App\Code\Search\Resources\ElasticSearch\Factories;

use App\Code\Search\Enum\SearchEnum;
use Exception;

class ElasticSearchPropertiesFactory
{
    public function getPropertiesByIndexName(string $indexType): array
    {
        switch ($indexType) {
            case SearchEnum::INDEX_TYPE_MESSAGES:
                return $this->getDirtBagProperties();
            default:
                throw new Exception('Wrong index name: '.$indexType);
        }
    }

    private function getDirtBagProperties(): array
    {
        return [
            'message' => [
                'type' => 'text'
            ],
            'user_id' => [
                'type' => 'integer'
            ],
            'created_at' => [
                'type' => 'date',
                'format' => 'yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis',
            ]
        ];
    }
}
