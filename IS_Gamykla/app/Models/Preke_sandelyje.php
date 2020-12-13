<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Preke_sandelyje extends Model
{
    use HasFactory;
    protected $table = 'preke_sandelyje';
    public $timestamps = false;
    /**
     * Get the comments for the blog post.
     */
    public function preke()
    {
        return $this->belongsTo(Preke::class, 'fk_prekeId');
    }
    public function uzsakymai(){
        return $this->hasMany(Uzsakymas_preke::class, 'fk_prekeSandelyjeId');
    }
}
