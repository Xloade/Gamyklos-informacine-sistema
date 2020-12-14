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
            'plotis' => 125],
            ['kaina' => 50.49,
            'svoris' => 0.2,
            'pavadinimas' => 'Guoliavietė',
            'aukstis' => 10,
            'ilgis' => 20,
            'plotis' => 50],
            ['kaina' => 120.5,
            'svoris' => 1.2,
            'pavadinimas' => 'Stuceris',
            'aukstis' => 100,
            'ilgis' => 100,
            'plotis' => 50],
            ['kaina' => 1075.50,
            'svoris' => 10.5,
            'pavadinimas' => 'Cilindras',
            'aukstis' => 1000,
            'ilgis' => 60,
            'plotis' => 60],
            ['kaina' => 10254.75,
            'svoris' => 1000,
            'pavadinimas' => 'Presas',
            'aukstis' => 1000,
            'ilgis' => 200,
            'plotis' => 250],
            ['kaina' => 150.50,
            'svoris' => 0.5,
            'pavadinimas' => 'Ausis',
            'aukstis' => 10,
            'ilgis' => 50,
            'plotis' => 10],
            ['kaina' => 25.50,
            'svoris' => 0.1,
            'pavadinimas' => 'Varžleraktis',
            'aukstis' => 300,
            'ilgis' => 10,
            'plotis' => 50],
            ['kaina' => 85.58,
            'svoris' => 0.2,
            'pavadinimas' => 'Įvorė',
            'aukstis' => 125,
            'ilgis' => 200,
            'plotis' => 125]
            
        ]);
    }
}
