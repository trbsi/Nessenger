<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    use HasFactory;

    public static function getCurrentIndexName(string $type): string
    {
        /** @var Index $index */
        $index = Index::where('index_type', $type)->where('is_default', 1)->first();
        return $index->getIndexName();
    }

    public function getIndexName(): string
    {
        return $this->indexName;
    }

    public function setIndexName(string $indexName): self
    {
        $this->indexName = $indexName;
        return $this;
    }

    public function getIndexType(): string
    {
        return $this->indexType;
    }

    public function setIndexType(string $indexType): self
    {
        $this->indexType = $indexType;
        return $this;
    }

    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    public function setIsDefault(bool $isDefault): self
    {
        $this->isDefault = $isDefault;
        return $this;
    }
}
