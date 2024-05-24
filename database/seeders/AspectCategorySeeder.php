<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AspectCategory;

class AspectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AspectCategory::create([
            'id' => 1,
            'name' => 'Kecerdasan'
        ]);

        AspectCategory::create([
            'id' => 2,
            'name' => 'Kepribadian'
        ]);

        AspectCategory::create([
            'id' => 3,
            'name' => 'Kecermatan'
        ]);
    }
}
