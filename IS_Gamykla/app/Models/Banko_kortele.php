<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banko_kortele extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'korteles_numeris','vardas', 'pavarde', 'cvv', 'galiojimo_pabaigos_menuo', 'galiojimo_pabaigos_metai', 'gatve', 'buto_nr', 'miestas', 'salis'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
