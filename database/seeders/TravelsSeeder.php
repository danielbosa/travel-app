<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TravelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('travels')->insert([
            'name' => 'Viaggio in Italia',
            'description' => 'Un bellissimo viaggio attraverso le città storiche d\'Italia.',
            'image' => 'https://example.com/path/to/your/image.jpg', // Metti qui un link all'immagine se necessario
            'date_start' => Carbon::parse('2024-09-01'), // Data di inizio
            'date_end' => Carbon::parse('2024-09-15'), // Data di fine
            'user_id' => 1, // Associa all'user con ID 1
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
