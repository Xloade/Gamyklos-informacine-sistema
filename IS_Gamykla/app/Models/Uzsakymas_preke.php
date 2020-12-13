<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzsakymas_preke extends Model
{
    use HasFactory;

    protected $table = 'uzsakymas_preke';
    public $timestamps = false;
    protected $fillable = [
        'kiekis', 'fk_uzsakymasId', 'fk_prekeSandelyjeId'
    ];
    public function info(){
        return $this->belongsTo(Uzsakymas::class, 'fk_uzsakymasId');
    }
}
