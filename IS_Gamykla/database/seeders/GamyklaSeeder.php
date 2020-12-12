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
            Panevėžys'],
            ['pavadinima' => 'Ratinė',
            'adresas' => 'Šiaurės pr.
            Klaipėda'],
            ['pavadinima' => 'Sriegykla',
            'adresas' => 'Tilto g.
            Gargždai'],
            ['pavadinima' => 'Medienos pliauskos',
            'adresas' => 'Pagojo g.
            Kvėdarna'],
            ['pavadinima' => 'Liejykla',
            'adresas' => 'J. Basanavičiaus g.
            Šilalė']
        ]);
    }
}
