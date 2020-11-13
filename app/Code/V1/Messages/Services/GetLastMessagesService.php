<?php

namespace App\Code\V1\Messages\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\IndexDocumentServiceInterface;
use App\Code\Search\Services\Interfaces\SearchIndexServiceInterface;
use App\Models\Index;
use Illuminate\Support\Facades\Auth;

class GetLastMessagesService
{
    public const MAX_RESULTS = 100;

    private SearchIndexServiceInterface $searchIndexService;

    public function __construct(SearchIndexServiceInterface $searchIndexService)
    {
        $this->searchIndexService = $searchIndexService;
    }

    public function getLastMessagesForCurrentUser(): array
    {
        if (null === Auth::id()) {
            return [];
        }

        $body = [
            'sort' => [
                [
                    'created_at' => 'asc',
                ],
            ],
            'size' => self::MAX_RESULTS,
            'query' => [
                'bool' => [
                    'must' => [
                        [
                            'term' => [
                                'user_id' => Auth::id(),
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return $this->searchIndexService->searchIndex(SearchEnum::INDEX_TYPE_MESSAGES, $body);
    }
}
