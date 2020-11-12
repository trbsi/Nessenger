<?php

declare(strict_types=1);

namespace App\Code\Search\Services;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\BulkIndexDocumentServiceInterface;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Code\Search\Services\Interfaces\DeleteIndexServiceInterface;
use App\Models\Index;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

final class ReindexSearchService
{
    private string $newIndexName;
    private string $oldIndexName;

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
        $this->newIndexName = sprintf('%s_%s', SearchEnum::INDEX_TYPE_MESSAGES, date('Y_m_d_H_i_s'));
        $this->oldIndexName = Index::getCurrentIndexName(SearchEnum::INDEX_TYPE_MESSAGES);
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

        $this->saveNewIndexAndRemoveOldOneFromDatabase();
        $this->deleteOldIndex();
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

    private function createIndex(): void
    {
        $this->createIndexService->createIndex(SearchEnum::INDEX_TYPE_MESSAGES, $this->newIndexName);
    }

    private function deleteOldIndex(): void
    {
        $this->deleteIndexService->deleteIndex($this->oldIndexName);
    }

    private function saveNewIndexAndRemoveOldOneFromDatabase()
    {
        Index::updateOrCreate(
            ['index_type' => SearchEnum::INDEX_TYPE_MESSAGES],
            [
                'index_name' => $this->newIndexName,
                'is_default' => true
            ]
        );
    }
}
