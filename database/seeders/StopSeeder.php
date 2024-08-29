<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StopSeeder extends Seeder
{
    public function run(): void
    {
        $stops = [
            // Day 1 (Firenze)
            ['name' => 'Piazza della Signoria', 'description' => 'Centro storico di Firenze.', 'vote' => 5, 'notes' => 'Visitare il Palazzo Vecchio.', 'day_id' => 1],
            ['name' => 'Cattedrale di Santa Maria del Fiore', 'description' => 'Famosa per la sua cupola.', 'vote' => 4, 'notes' => 'Non perdere la vista dalla cupola.', 'day_id' => 1],
            ['name' => 'Ponte Vecchio', 'description' => 'Iconico ponte medievale.', 'vote' => 5, 'notes' => 'Ottimo per foto.', 'day_id' => 1],

            // Day 2 (Montepulciano)
            ['name' => 'Piazza Grande', 'description' => 'Piazza principale di Montepulciano.', 'vote' => 4, 'notes' => 'Visitare il Palazzo Comunale.', 'day_id' => 2],
            ['name' => 'Duomo di Montepulciano', 'description' => 'Cattedrale nel cuore della città.', 'vote' => 3, 'notes' => 'Bella architettura.', 'day_id' => 2],
            ['name' => 'Cantina Nobile', 'description' => 'Degustazione di vino Nobile.', 'vote' => 5, 'notes' => 'Imperdibile per gli amanti del vino.', 'day_id' => 2],

            // Day 3 (Siena)
            ['name' => 'Piazza del Campo', 'description' => 'Famosa per il Palio di Siena.', 'vote' => 5, 'notes' => 'Passeggiare e godersi l\'atmosfera.', 'day_id' => 3],
            ['name' => 'Duomo di Siena', 'description' => 'Magnifica cattedrale gotica.', 'vote' => 5, 'notes' => 'Non perdere il pavimento decorato.', 'day_id' => 3],
            ['name' => 'Torre del Mangia', 'description' => 'Torre con vista panoramica sulla città.', 'vote' => 4, 'notes' => 'Climb the tower for a stunning view.', 'day_id' => 3],
        ];

        // data into table
        DB::table('stops')->insert($stops);
    }
}
