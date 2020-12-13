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
        [
            'first_name' => 'Pirkejas',
            'last_name' => 'Pirkejas',
            'email' => 'pirkejas@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 1
        ],
        [
            'first_name' => 'Jonas',
            'last_name' => 'Pirkejas',
            'email' => 'pirkejas1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 1
        ],
        [
            'first_name' => 'Stasys',
            'last_name' => 'Pirkejas',
            'email' => 'pirkejas2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 1
        ],
        [
            'first_name' => 'Darbuotojas',
            'last_name' => 'Darbuotojas',
            'email' => 'Darbuotojas@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 3
        ],
        [
            'first_name' => 'Darbuotojas2',
            'last_name' => 'Darbuotojas2',
            'email' => 'Darbuotojas2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 3
        ],
        [
            'first_name' => 'Vadovas',
            'last_name' => 'Pirmas',
            'email' => 'vad1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 5
        ],
        [
            'first_name' => 'Vadovas',
            'last_name' => 'Antras',
            'email' => 'vad2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 3
        ],
        [
            'first_name' => 'Vadovas',
            'last_name' => 'Ketvirtas',
            'email' => 'vad4@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 3
        ],
        [
            'first_name' => 'Vadovas',
            'last_name' => 'Trečias',
            'email' => 'vad3@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 3
        ],
        [
            'first_name' => 'Antanas',
            'last_name' => 'Gauba',
            'email' => 'Darbuotojas3@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 3
        ],
        [
            'first_name' => 'Ąžuolas',
            'last_name' => 'Darbuotojas',
            'email' => 'Darbuotojas4@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userlevel' => 3
        ],
        [
            'first_name' => 'Administratorius',
            'last_name' => 'Administratorius',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'userlevel' => 9
        ],
        [
            'first_name' => 'Administratorius2',
            'last_name' => 'Administratorius2',
            'email' => 'admin2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'userlevel' => 9
        ]]);
    }
}
