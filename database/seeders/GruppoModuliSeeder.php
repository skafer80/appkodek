<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GruppoModuliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\GruppoModuli::insert([
            [
                'nome' => 'Collaborare alla gestione del magazzino',
                'ore_stage' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Collaborare alla gestione dei flussi (materie prime, semilavorati, merci, prodotti finiti) in entrata e allo stoccaggio',
                'ore_stage' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Collaborare alla gestione dei flussi (materie prime, semilavorati, merci, prodotti finiti) in uscita',
                'ore_stage' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
