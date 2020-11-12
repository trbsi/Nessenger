<?php

namespace App\Code\V1\Messages\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\IndexDocumentServiceInterface;
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

        $message = htmlspecialchars($message);
        //https://stackoverflow.com/questions/12819804/how-do-i-use-htmlspecialchars-but-allow-only-specific-html-code-to-pass-through
        $message = preg_replace('#&lt;(/?(?:br|a))&gt;#', '<\1>', $message);
        $message = $this->messageUrlDetector->replaceUrlWithClickableLinks($message);

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

        $this->indexDocumentService->indexDocument(SearchEnum::INDEX_TYPE_MESSAGES, $data);

        return $model;
    }
}
