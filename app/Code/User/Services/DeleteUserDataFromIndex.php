<?php

declare(strict_types=1);

namespace App\Code\User\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\DeleteByQueryServiceInterface;
use App\Models\Index;

final class DeleteUserDataFromIndex
{
    private DeleteByQueryServiceInterface $deleteByQueryService;

    public function __construct(DeleteByQueryServiceInterface $deleteByQueryService)
    {
        $this->deleteByQueryService = $deleteByQueryService;
    }

    public function deleteDataFromIndex(int $userId): void
    {
        $query = [
            'match' => [
                'user_id' => $userId
            ]
        ];
        $this->deleteByQueryService->deleteByQuery(SearchEnum::INDEX_TYPE_MESSAGES, $query);
    }
}
