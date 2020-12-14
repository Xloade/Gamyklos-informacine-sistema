<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TvarkarastisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tvarkarastis')->insert([
            ['data' => '2020-02-14 14:43:59',
            'darbas_nuo' => 10,
            'darbas_iki' => 18,
            'fk_darbuotojasId' => 4],
            ['data' => '2020-03-14 14:43:59',
            'darbas_nuo' => 2,
            'darbas_iki' => 18,
            'fk_darbuotojasId' => 9],
            ['data' => '2020-08-25 14:43:59',
            'darbas_nuo' => 9,
            'darbas_iki' => 18,
            'fk_darbuotojasId' => 8],
            ['data' => '2020-10-02 14:43:59',
            'darbas_nuo' => 12,
            'darbas_iki' => 15,
            'fk_darbuotojasId' => 8]
        ]);
    }
}
