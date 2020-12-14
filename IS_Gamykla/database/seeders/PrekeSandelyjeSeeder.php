<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrekeSandelyjeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preke_sandelyje')->insert([
            ['kiekis' => 125,
            'fk_sandelisId' => 1,
            'fk_prekeId' => 1],
            ['kiekis' => 10,
            'fk_sandelisId' => 1,
            'fk_prekeId' => 2],
            ['kiekis' => 2000,
            'fk_sandelisId' => 3,
            'fk_prekeId' => 1],
            ['kiekis' => 100,
            'fk_sandelisId' => 1,
            'fk_prekeId' => 5],
            ['kiekis' => 125,
            'fk_sandelisId' => 3,
            'fk_prekeId' => 4],
            ['kiekis' => 145,
            'fk_sandelisId' => 3,
            'fk_prekeId' => 6],
            ['kiekis' => 100,
            'fk_sandelisId' => 3,
            'fk_prekeId' => 2],
            ['kiekis' => 15000,
            'fk_sandelisId' => 1,
            'fk_prekeId' => 3],
            ['kiekis' => 12,
            'fk_sandelisId' => 1,
            'fk_prekeId' => 4],
            ['kiekis' => 0,
            'fk_sandelisId' => 2,
            'fk_prekeId' => 6],
            ['kiekis' => 125,
            'fk_sandelisId' => 3,
            'fk_prekeId' => 1],
            ['kiekis' => 15,
            'fk_sandelisId' => 1,
            'fk_prekeId' => 6],
            ['kiekis' => 12,
            'fk_sandelisId' => 2,
            'fk_prekeId' => 6],
            ['kiekis' => 0,
            'fk_sandelisId' => 3,
            'fk_prekeId' => 7]
            
        ]);
    }
}
