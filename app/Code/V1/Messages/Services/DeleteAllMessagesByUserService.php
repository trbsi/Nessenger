<?php

namespace App\Code\V1\Messages\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\DeleteByQueryServiceInterface;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class DeleteAllMessagesByUserService
{
    private DeleteByQueryServiceInterface $deleteByQueryService;

    public function __construct(DeleteByQueryServiceInterface $deleteByQueryService)
    {
        $this->deleteByQueryService = $deleteByQueryService;
    }

    public function deleteAllByUser(): void
    {
        $this->deleteFromDatabase();
        $this->deleteFromSearch();
    }

    private function deleteFromDatabase():  void
    {
        Message::where('user_id', Auth::id())->delete();
    }

    private function deleteFromSearch(): void
    {
        $query = [
            'query' => [
                'match' => [
                    'user_id' => Auth::id()
                ]
            ]
        ];
        $this->deleteByQueryService->deleteByQuery(SearchEnum::INDEX_TYPE_MESSAGES, $query);
    }
}
