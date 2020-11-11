<?php

namespace App\Code\V1\Messages\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\IndexDocumentServiceInterface;
use App\Models\Index;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class SaveMessageService
{
    private IndexDocumentServiceInterface $indexDocumentService;

    public function __construct(IndexDocumentServiceInterface $indexDocumentService)
    {
        $this->indexDocumentService = $indexDocumentService;
    }

    public function saveMessage(string $message)
    {
        if (strlen($message) > 65000) {
            $message = substr($message, 0, 65000);
        }

        $model = new Message();
        $model
            ->setMessage($message)
            ->setUserId(Auth::id());
        $model->save();

        $data = [
            'message' => $model->getMessage(),
            'created_at' => $model->getCreatedAt(),
            'user_id' => $model->getUserId(),
        ];

        $indexName = Index::getCurrentIndexName(SearchEnum::INDEX_TYPE_MESSAGES);
        $this->indexDocumentService->indexDocument($indexName, $data);
    }
}
