<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sandelis extends Model
{
    use HasFactory;

    protected $table = 'sandeliai';
    protected $primaryKey = 'sandelio_kodas';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salis','miestas', 'gatve', 'talpa'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    /**
     * Get the what is in sandelis.
     */
    public function sandelyje()
    {
        return $this->hasMany(Preke_sandelyje::class, 'fk_sandelisId');
    }
}
