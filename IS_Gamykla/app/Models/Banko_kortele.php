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
        'Korteles_numeris','Vardas', 'Pavarde', 'CVV', 'Galiojimo_pabaigos_menuo', 'Galiojimo_pabaigos_metai', 'Gatve', 'Buto_nr', 'Miestas', 'Salis'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
