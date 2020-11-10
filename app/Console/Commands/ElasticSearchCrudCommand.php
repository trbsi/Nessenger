<?php

namespace App\Console\Commands;

use App\Code\Search\Enum\SearchEnum;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Code\Search\Services\Interfaces\DeleteIndexServiceInterface;
use App\Code\Search\Services\Interfaces\IndexDocumentServiceInterface;
use Illuminate\Console\Command;
use Elasticsearch\ClientBuilder;

class ElasticSearchCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:crud {index-name=default} {--delete=0} {--index-doc=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates index for our ES';

    private CreateIndexServiceInterface $createIndexService;
    private DeleteIndexServiceInterface $deleteIndexService;
    private IndexDocumentServiceInterface $indexDocumentService;
    private string $indexName;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        CreateIndexServiceInterface $createIndexService,
        DeleteIndexServiceInterface $deleteIndexService,
        IndexDocumentServiceInterface $indexDocumentService
    ) {
        parent::__construct();
        $this->createIndexService = $createIndexService;
        $this->deleteIndexService = $deleteIndexService;
        $this->indexDocumentService = $indexDocumentService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->indexName = $this->argument('index-name');
        $deleteIndex = (bool) $this->option('delete');
        $indexDocument = (bool) $this->option('index-doc');
        if ($this->indexName === 'default') {
            $this->indexName = SearchEnum::INDEX_NAME_MESSAGES;
        }

        if ($deleteIndex) {
            $this->delete();
            $response = $this->create();
        } elseif($indexDocument) {
            $response = $this->indexDocument();
        } else {
            $response = $this->create();
        }

        $this->info(json_encode($response));
        return 0;
    }

    private function delete(): array
    {
        return $this->deleteIndexService->deleteIndex($this->indexName);
    }

    private function create(): array
    {
        return $this->createIndexService->createIndex($this->indexName);
    }

    private function indexDocument(): array
    {
        $body = [
            'message' => 'https://www.reddit.com/r/FlutterDev/comments/fuq904/rich_push_notifications_ios/',
            'user_id' => 8888,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        return $this->indexDocumentService->indexDocument($this->indexName, $body);
    }
}
