<?php

declare(strict_types=1);

namespace App\Code\V1\Messages\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\IndexDocumentServiceInterface;
use App\Code\Search\Services\Interfaces\SearchIndexServiceInterface;
use App\Models\Index;
use Illuminate\Support\Facades\Auth;

final class SearchMessagesService
{
    private SearchIndexServiceInterface $searchIndexService;

    public function __construct(
        SearchIndexServiceInterface $searchIndexService
    ){
        $this->searchIndexService = $searchIndexService;
    }

    public function search(string $term): array
    {
        if (strlen($term) <= 3) {
            return [];
        }

        $query = [
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
                                'user_id' => Auth::id(),
                            ],
                        ],
                        [
                            'wildcard' => [
                                'message' => [
                                    'value' => sprintf('*%s*', $term),
                                    'boost' => 1,
                                    'rewrite' => 'constant_score',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $results = $this->searchIndexService->searchIndex(SearchEnum::INDEX_TYPE_MESSAGES, $query);
        $results = array_map(function ($result) {
            return $result['_source'];
        }, $results);
        return $results;
    }
}
