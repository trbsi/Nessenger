<?php

declare(strict_types=1);

namespace App\Code\Search\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\BulkIndexDocumentServiceInterface;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Code\Search\Services\Interfaces\DeleteIndexServiceInterface;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

final class ReindexSearchService
{
    private string $newIndexName;

    private CreateIndexServiceInterface $createIndexService;
    private DeleteIndexServiceInterface $deleteIndexService;
    private BulkIndexDocumentServiceInterface $bulkIndexDocumentService;

    public function __construct(
        CreateIndexServiceInterface $createIndexService,
        DeleteIndexServiceInterface $deleteIndexService,
        BulkIndexDocumentServiceInterface $bulkIndexDocumentService
    ) {
        $this->createIndexService = $createIndexService;
        $this->deleteIndexService = $deleteIndexService;
        $this->bulkIndexDocumentService = $bulkIndexDocumentService;
        $this->newIndexName = sprintf('%s_%s', SearchEnum::INDEX_TYPE_MESSAGES, date('Y_m_d'));
    }

    public function reindex(int $perPage): void
    {
        $offset = 0;
        $this->createIndex();
        do {
            /** @var Collection $messages */
            $messages = Message::limit($perPage)->offset($offset)->get();
            $this->indexDocuments($messages);
            $offset = $offset + $perPage;
        } while($messages->isNotEmpty());
        //SAVE IN OUR DB, SET AS DEFAULT
        //REMOVE OLD indexes from DB
        //DELETE OLD INDEX
    }

    private function createIndex(): void
    {
        $this->createIndexService->createIndex(/*TODO*/);
    }

    private function indexDocuments(Collection $messages): void
    {
        if ($messages->isEmpty()) {
            return;
        }

        /** @var Message $message */
        foreach($messages as $message) {
            $params['body'][] = [
                'index' => [
                    '_index' => $this->newIndexName,
                ]
            ];

            $params['body'][] = [
                'message'     => $message->getMessage(),
                'created_at' => $message->getCreatedAt(),
                'user_id' => $message->getUserId(),
            ];
        }

        $this->bulkIndexDocumentService->indexDocuments($params);
    }

    private function deleteIndex(): void
    {

    }
}
