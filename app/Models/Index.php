<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    protected $table = 'indexes';

    protected $fillable = ['index_name', 'index_type', 'is_default'];

    use HasFactory;

    public static function getCurrentIndexName(string $type): string
    {
        /** @var Index $index */
        $index = Index::where('index_type', $type)->where('is_default', 1)->first();
        return $index->getIndexName();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIndexName(): string
    {
        return $this->index_name;
    }

    public function setIndexName(string $indexName): self
    {
        $this->index_name = $indexName;
        return $this;
    }

    public function getIndexType(): string
    {
        return $this->index_type;
    }

    public function setIndexType(string $indexType): self
    {
        $this->index_type = $indexType;
        return $this;
    }

    public function isDefault(): bool
    {
        return $this->is_default;
    }

    public function setIsDefault(bool $isDefault): self
    {
        $this->is_default = $isDefault;
        return $this;
    }
}
