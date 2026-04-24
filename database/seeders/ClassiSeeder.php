<?php

namespace Database\Seeders;

use App\Models\classroom;
use Illuminate\Database\Seeder;

class ClassiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        classroom::insert([
            [
                'nome' => 'CS1326-ED2684',
                'indirizzo' => 'VIA G. ROMITA',
                'numero_civico' => 2,
                'cap' => 93100,
                'citta' => 'Caltanissetta',
                'provincia' => 'Caltanissetta',
                'totale_ore' => 554,
                'formazione_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'CS1327-ED2685',
                'indirizzo' => 'VIA L. BERTETT',
                'numero_civico' => 100,
                'cap' => 90121,
                'citta' => 'Palermo',
                'provincia' => 'Palermo',
                'totale_ore' => 554,
                'formazione_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'CS1328-ED2686',
                'indirizzo' => 'VIA G. ROMITA',
                'numero_civico' => 2,
                'cap' => 93100,
                'citta' => 'Caltanissetta',
                'provincia' => 'Caltanissetta',
                'totale_ore' => 554,
                'formazione_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'CS1329-ED2687',
                'indirizzo' => 'VIA L. BERTETT',
                'numero_civico' => 100,
                'cap' => 90121,
                'citta' => 'Palermo',
                'provincia' => 'Palermo',
                'totale_ore' => 554,
                'formazione_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
