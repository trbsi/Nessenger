<?php


namespace App\Code\Search\Services\Interfaces;


interface DeleteIndexServiceInterface
{
    public function deleteIndex(string $indexName): array;
}
