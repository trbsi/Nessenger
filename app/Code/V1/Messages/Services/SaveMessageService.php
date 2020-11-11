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
    private MessageUrlDetector $messageUrlDetector;

    public function __construct(
        IndexDocumentServiceInterface $indexDocumentService,
        MessageUrlDetector $messageUrlDetector
    ){
        $this->indexDocumentService = $indexDocumentService;
        $this->messageUrlDetector = $messageUrlDetector;
    }

    public function saveMessage(string $message): Message
    {
        //because column type in MySql is "text"
        if (strlen($message) > 65000) {
            $message = substr($message, 0, 65000);
        }

        $message = $this->messageUrlDetector->replaceUrlWithClickableLinks($message);
        $message = strip_tags($message, '<a><br>');

        $model = $this->saveAndIndex($message);
        return $model;
    }

    private function saveAndIndex(string $message): Message
    {
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

        return $model;
    }
}
