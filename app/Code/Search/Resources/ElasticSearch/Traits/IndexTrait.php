<?php

declare(strict_types=1);

namespace App\Code\Search\Resources\ElasticSearch\Traits;

use App\Models\Index;

trait IndexTrait
{
    public function getIndexName(string $indexType): string
    {
        return Index::getCurrentIndexName($indexType);
    }
}
