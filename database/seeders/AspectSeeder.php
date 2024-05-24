<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aspect;

class AspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aspect::create([
            'aspect_category_id' => 1,
            'name' => 'Berfikir Praktis',
            'long_name' => 'Kemampuan Berfikir Praktis'
        ]);

        Aspect::create([
            'aspect_category_id' => 1,
            'name' => 'Berfikir Verbal',
            'long_name' => 'Kemampuan Berfikir Verbal'
        ]);

        Aspect::create([
            'aspect_category_id' => 1,
            'name' => 'Berfikir Logis',
            'long_name' => 'Kemampuan Berfikir Logis'
        ]);

        Aspect::create([
            'aspect_category_id' => 1,
            'name' => 'Berfikir Analitis',
            'long_name' => 'Kemampuan Berfikir Analitis'
        ]);

        Aspect::create([
            'aspect_category_id' => 2,
            'name' => 'Stabilitas Emosi',
            'long_name' => 'Stabilitas Emosi'
        ]);

        Aspect::create([
            'aspect_category_id' => 2,
            'name' => 'Prososial',
            'long_name' => 'Prososial'
        ]);

        Aspect::create([
            'aspect_category_id' => 2,
            'name' => 'Penyesuaian Diri',
            'long_name' => 'Penyesuaian Diri'
        ]);

        Aspect::create([
            'aspect_category_id' => 2,
            'name' => 'Kepercayaan Diri',
            'long_name' => 'Kepercayaan Diri'
        ]);

        Aspect::create([
            'aspect_category_id' => 2,
            'name' => 'Motif Berprestasi',
            'long_name' => 'Motif Berprestasi'
        ]);

        Aspect::create([
            'aspect_category_id' => 2,
            'name' => 'Pengambilan Keputusan',
            'long_name' => 'Pengambilan Keputusan'
        ]);

        Aspect::create([
            'aspect_category_id' => 3,
            'name' => 'Kecepatan',
            'long_name' => 'Kecepatan'
        ]);

        Aspect::create([
            'aspect_category_id' => 3,
            'name' => 'Ketelitian',
            'long_name' => 'Ketelitian'
        ]);

        Aspect::create([
            'aspect_category_id' => 3,
            'name' => 'Ketahanan',
            'long_name' => 'Ketahanan'
        ]);
    }
}
