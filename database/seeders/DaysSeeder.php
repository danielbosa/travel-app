<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('days')->insert([
            ['name' => 'Giorno 1 - Firenze', 'done' => false, 'order' => 1, 'travel_id' => 1],
            ['name' => 'Giorno 2 - Montepulciano', 'done' => false, 'order' => 2, 'travel_id' => 1],
            ['name' => 'Giorno 3 - Siena', 'done' => false, 'order' => 3, 'travel_id' => 1],
        ]);
    }
}
