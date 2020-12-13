<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamyklaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gamykla')->insert([
            ['pavadinimas' => 'Varžtinė',
            'adresas' => 'Vasario 16-Osios g. 60
            Panevėžys',
            'fk_userId' => null],
            ['pavadinima' => 'Ratinė',
            'adresas' => 'Šiaurės pr.
            Klaipėda',
            'fk_userId' => 7],
            ['pavadinima' => 'Sriegykla',
            'adresas' => 'Tilto g.
            Gargždai',
            'fk_userId' => 8],
            ['pavadinima' => 'Medienos pliauskos',
            'adresas' => 'Pagojo g.
            Kvėdarna',
            'fk_userId' => null],
            ['pavadinima' => 'Liejykla',
            'adresas' => 'J. Basanavičiaus g.
            Šilalė',
            'fk_userId' => null]
        ]);
    }
}
