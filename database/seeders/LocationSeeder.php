<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data for Florence
        $florenceLocations = [
            ['name' => 'Piazza della Signoria', 'lat' => 43.7674, 'lng' => 11.2532, 'stop_id' => 1],
            ['name' => 'Duomo di Firenze', 'lat' => 43.7731, 'lng' => 11.2561, 'stop_id' => 2],
            ['name' => 'Uffizi Gallery', 'lat' => 43.7675, 'lng' => 11.2550, 'stop_id' => 3],
        ];

        // Data for Montepulciano
        $montepulcianoLocations = [
            ['name' => 'Piazza Grande', 'lat' => 43.0897, 'lng' => 11.7872, 'stop_id' => 4],
            ['name' => 'Tempio di San Biagio', 'lat' => 43.0848, 'lng' => 11.7922, 'stop_id' => 5],
            ['name' => 'Palazzo Comunale', 'lat' => 43.0899, 'lng' => 11.7886, 'stop_id' => 6],
        ];

        // Data for Siena
        $sienaLocations = [
            ['name' => 'Piazza del Campo', 'lat' => 43.3188, 'lng' => 11.3308, 'stop_id' => 7],
            ['name' => 'Duomo di Siena', 'lat' => 43.3181, 'lng' => 11.3300, 'stop_id' => 8],
            ['name' => 'Basilica di San Domenico', 'lat' => 43.3171, 'lng' => 11.3317, 'stop_id' => 9],
        ];

        // Insert data into locations table
        DB::table('locations')->insert(array_merge($florenceLocations, $montepulcianoLocations, $sienaLocations));
    }
}
