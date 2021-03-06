<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preke extends Model
{
    use HasFactory;
    protected $table = 'preke';
    protected $primaryKey = 'prekes_kodas';
    public $timestamps = false;

    protected $fillable = [
        'pavadinimas', 'kaina', 'svoris', 'aukstis', 'ilgis', 'plotis'
    ];

    public function sandeliuose(){
        return $this->hasMany(Preke_sandelyje::class, 'fk_prekeId');
    }
}
