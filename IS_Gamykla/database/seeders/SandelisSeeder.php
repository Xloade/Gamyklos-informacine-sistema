<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SandelisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sandeliai')->insert([
            ['salis' => 'Lietuva',
            'miestas' => 'Kaunas',
            'gatve' => 'Elektrėnų g. 8',
            'talpa' => 2500,
            'fk_vadovasId' => null],
            ['salis' => 'Lietuva',
            'miestas' => 'Vilnius',
            'gatve' => 'Partizanų g. 20a',
            'talpa' => 3800,
            'fk_vadovasId' => 6],
            ['salis' => 'Latvija',
            'miestas' => 'Ryga',
            'gatve' => 'Andreja Saharova  g. 14',
            'talpa' => 100,
            'fk_vadovasId' => null]
        ]);
    }
}
