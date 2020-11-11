<?php

namespace App\Console\Commands;

use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Code\Search\Services\Interfaces\DeleteIndexServiceInterface;
use App\Code\Search\Services\ReindexSearchService;
use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Artisan;

class ReindexSearchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex {per-page=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used for reindexing search';

    private ReindexSearchService $reindexSearchService;

    public function __construct(
        ReindexSearchService $reindexSearchService
    ) {
        parent::__construct();
        $this->reindexSearchService = $reindexSearchService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('down');
        $this->info('Started with indexing');
        $perPage = $this->argument('per-page');
        $this->reindexSearchService->reindex($perPage);
        $this->info('Indexing done');
        Artisan::call('up');
        return 0;
    }
}
