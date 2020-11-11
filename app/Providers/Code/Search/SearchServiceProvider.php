<?php

declare(strict_types=1);

namespace App\Providers\Code\Search;

use App\Code\Search\Resources\ElasticSearch\Services\BulkIndexDocumentService;
use App\Code\Search\Resources\ElasticSearch\Services\CreateIndexService;
use App\Code\Search\Resources\ElasticSearch\Services\DeleteByQueryService;
use App\Code\Search\Resources\ElasticSearch\Services\DeleteIndexService;
use App\Code\Search\Resources\ElasticSearch\Services\IndexDocumentService;
use App\Code\Search\Resources\ElasticSearch\Services\SearchIndexService;
use App\Code\Search\Services\Interfaces\BulkIndexDocumentServiceInterface;
use App\Code\Search\Services\Interfaces\CreateIndexServiceInterface;
use App\Code\Search\Services\Interfaces\DeleteByQueryServiceInterface;
use App\Code\Search\Services\Interfaces\DeleteIndexServiceInterface;
use App\Code\Search\Services\Interfaces\IndexDocumentServiceInterface;
use App\Code\Search\Services\Interfaces\SearchIndexServiceInterface;
use Illuminate\Support\ServiceProvider;

final class SearchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CreateIndexServiceInterface::class, CreateIndexService::class);
        $this->app->bind(DeleteIndexServiceInterface::class, DeleteIndexService::class);
        $this->app->bind(IndexDocumentServiceInterface::class, IndexDocumentService::class);
        $this->app->bind(BulkIndexDocumentServiceInterface::class, BulkIndexDocumentService::class);
        $this->app->bind(SearchIndexServiceInterface::class, SearchIndexService::class);
        $this->app->bind(DeleteByQueryServiceInterface::class, DeleteByQueryService::class);
    }
}
