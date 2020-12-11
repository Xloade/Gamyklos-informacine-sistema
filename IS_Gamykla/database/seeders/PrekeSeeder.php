<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrekeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('preke')->insert([
            ['kaina' => 99.99,
            'svoris' => 50,
            'pavadinimas' => 'Didelis varžtas',
            'aukstis' => 50,
            'ilgis' => 125,
            'plotis' => 125]
        ]);
    }
}
