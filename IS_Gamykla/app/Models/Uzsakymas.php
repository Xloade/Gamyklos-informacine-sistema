<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uzsakymas extends Model
{
    use HasFactory;
    protected $table = 'uzsakymas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'salis','miestas', 'gatve', 'buto_nr', 'uzsakymo_statusas', 'pristatymo_komentaras','duru_kodas','fk_userId','fk_bankoKorteleId'
    ];
}
