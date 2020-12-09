<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Pirkejas',
            'last_name' => 'Pirkejas',
            'email' => 'pirkejas@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 1
        ]);
    }
}
