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
            'talpa' => 2500],
            ['salis' => 'Lietuva',
            'miestas' => 'Vilnius',
            'gatve' => 'Partizanų g. 20a',
            'talpa' => 3800],
            ['salis' => 'Latvija',
            'miestas' => 'Ryga',
            'gatve' => 'Andreja Saharova  g. 14',
            'talpa' => 1000]
        ]);
    }
}
