<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannkoKortelesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banko_korteles')->insert([
            ['korteles_numeris' => '6589632554785236',
            'vardas' => 'Pirkejas',
            'pavarde' => 'Pavardenis',
            'cvv' => '632',
            'galiojimo_pabaigos_menuo' => '5',
            'galiojimo_pabaigos_metai' => '22',
            'gatve' => 'kalno g. 5',
            'buto_nr' => '256',
            'miestas' => 'Rokiškis',
            'salis' => 'Lietuva',
            'fk_userId' => '1']
        ]);
    }
}
