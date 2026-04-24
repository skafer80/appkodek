<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormazioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Formazione::insert([
            [
                'titolo' => 'Addetto alla sistemazione e manutenzione aree verdi',
                'area' => 'AGRO-ALIMENTARE',
                'sotto_area' => 'Agricoltura, silvicoltura e pesca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titolo' => 'Collaboratore di cucina',
                'area' => 'TURISMO E SPORT - SERVIZI TURISTICI',
                'sotto_area' => 'Servizi turistici',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titolo' => 'Collaboratore di sala e bar',
                'area' => 'TURISMO E SPORT - SERVIZI TURISTICI',
                'sotto_area' => 'Servizi turistici',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titolo' => 'Addetto vendite',
                'area' => 'SERVIZI COMMERCIALI - AREA COMUNE',
                'sotto_area' => 'Area comune (inclusiva dei servizi alle imprese)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titolo' => 'Addetto magazzino e logistica',
                'area' => 'SERVIZI COMMERCIALI - AREA COMUNE',
                'sotto_area' => 'Area comune (inclusiva dei servizi alle imprese)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titolo' => 'Operatore informatico di risorse web',
                'area' => 'CULTURA INFORMAZIONE E TECNOLOGIE INFORMATICHE',
                'sotto_area' => 'Servizi di Informatica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titolo' => 'Tecnico meccatronico delle autoriparazioni',
                'area' => 'CULTURA MANIFATTURIERA, MECCANICO E ARTIGIANATO',
                'sotto_area' => 'Meccanica; produzione e manutenzione di macchine; impiantistica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titolo' => 'Addetto impianti elettrici civili',
                'area' => 'EDILIZIA ED IMPIANTI',
                'sotto_area' => 'Edilizia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
