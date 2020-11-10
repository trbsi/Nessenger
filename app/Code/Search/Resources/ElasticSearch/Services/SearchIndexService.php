<?php

namespace App\Code\Search\Resources\ElasticSearch\Services;

use App\Code\Search\Services\Interfaces\SearchIndexServiceInterface;
use Elasticsearch\ClientBuilder;

class SearchIndexService implements SearchIndexServiceInterface
{
    public function searchIndex(string $indexName, array $query): array
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => $indexName,
            'body'  => [
                'query' => $query
            ]
        ];

        $results = $client->search($params);
        return $results;
    }
}

/*
[
	'sort' => [
		[
			'created_at' => 'desc',
		],
    ],
	'query' => [
		'bool' => [
			'must' => [
				[
					'term' => [
						'user_id' => 8888,
					],
				],
				[
					'wildcard' => [
						'message' => [
							'value' => '*pevex*',
							'boost' => 1,
							'rewrite' => 'constant_score',
						],
					],
				],
			],
		],
	],
],

{
	"sort": [
		{
			"created_at": "desc"
		}
	],
	"query": {
		"bool": {
			"must": [
				{
					"term": {
						"user_id": 8888
					}
				},
				{
					"wildcard": {
						"message": {
							"value": "*flutter*",
							"boost": 1,
							"rewrite": "constant_score"
						}
					}
				}
			]
		}
	}
}
*/
