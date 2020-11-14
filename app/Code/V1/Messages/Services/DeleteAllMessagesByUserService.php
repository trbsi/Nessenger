<?php

namespace App\Code\V1\Messages\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\DeleteByQueryServiceInterface;

class DeleteAllMessagesByUserService
{
    private DeleteByQueryServiceInterface $deleteByQueryService;

    public function __construct(DeleteByQueryServiceInterface $deleteByQueryService)
    {
        $this->deleteByQueryService = $deleteByQueryService;
    }

    public function deleteAllByUser(): void
    {
        $this->deleteByQueryService->deleteByQuery(SearchEnum::INDEX_TYPE_MESSAGES);
    }
}
