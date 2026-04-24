<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Moduli::insert([
            [
                'nome' => 'Elementi di merceologia',
                'gruppo_moduli_id' => 1,
                'formazione_id' => 5,
                'ore_aula' => 48,
                'ore_fad' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Elementi di approvvigionamento e logistica',
                'gruppo_moduli_id' => 1,
                'formazione_id' => 5,
                'ore_aula' => 54,
                'ore_fad' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Tecniche di gestione del magazzino',
                'gruppo_moduli_id' => 1,
                'formazione_id' => 5,
                'ore_aula' => 48,
                'ore_fad' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Rischi specifici correlati alle attività  di gestione magazzino',
                'gruppo_moduli_id' => 1,
                'formazione_id' => 5,
                'ore_aula' => 48,
                'ore_fad' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Procedure di ricevimento',
                'gruppo_moduli_id' => 2,
                'formazione_id' => 5,
                'ore_aula' => 50,
                'ore_fad' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Elementi di stoccaggio delle merci',
                'gruppo_moduli_id' => 2,
                'formazione_id' => 5,
                'ore_aula' => 48,
                'ore_fad' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Elementi di stoccaggio delle merci',
                'gruppo_moduli_id' => 3,
                'formazione_id' => 5,
                'ore_aula' => 54,
                'ore_fad' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
