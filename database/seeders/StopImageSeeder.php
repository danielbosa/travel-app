<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StopImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            ['stop_id' => 1, 'image_path' => 'piazza_signoria_firenze.jpg'],
            ['stop_id' => 2, 'image_path' => 'cattedrale_santa_maria_del_fiore_firenze.jpg'],
            ['stop_id' => 3, 'image_path' => 'ponte_vecchio.jpg'],
            ['stop_id' => 4, 'image_path' => 'piazza_grande_montepulciano.jpg'],
            ['stop_id' => 5, 'image_path' => 'duomo_montepulciano.jpg'],
            ['stop_id' => 6, 'image_path' => 'cantina_nobile.jpg'],
            ['stop_id' => 7, 'image_path' => 'piazza_del_campo_siena.jpg'],
            ['stop_id' => 8, 'image_path' => 'duomo_siena.jpg'],
            ['stop_id' => 9, 'image_path' => 'torre_del_mangia_siena.jpg'],
        ];

        DB::table('stop_images')->insert($images);
    }
}
