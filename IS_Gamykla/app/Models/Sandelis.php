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
    public $timestamps = false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salis', 'miestas', 'gatve', 'talpa', 'fk_vadovasId'
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

    public function boss()
    {
        return $this->hasOne(User::class, 'fk_vadovasId', 'id');
    }

    public function sandelyje()
    {
        return $this->hasMany(Preke_sandelyje::class, 'fk_sandelisId');
    }
}
