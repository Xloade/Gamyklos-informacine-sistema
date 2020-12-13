<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tvarkarastis extends Model
{
    use HasFactory;

    protected $table = 'tvarkarastis';
    protected $primaryKey = 'id';
    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data','darbas_nuo', 'darbas_iki', 'fk_darbuotojasId', 'fk_vadovasId'
    ];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function boss()
    {
        return $this->hasOne(User::class, 'id', 'fk_vadovasId');
    }

    public function worker()
    {
        return $this->hasOne(User::class, 'id', 'fk_darbuotojasId');
    }
}
