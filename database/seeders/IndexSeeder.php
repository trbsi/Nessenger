<?php

namespace Database\Seeders;

use App\Code\Search\Enum\SearchEnum;
use App\Models\Index;
use Illuminate\Database\Seeder;

class IndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $index = new Index();
        $index
            ->setIndexName(SearchEnum::INDEX_TYPE_MESSAGES)
            ->setIndexType(SearchEnum::INDEX_TYPE_MESSAGES)
            ->setIsDefault(true);

        $index->save();
    }
}
