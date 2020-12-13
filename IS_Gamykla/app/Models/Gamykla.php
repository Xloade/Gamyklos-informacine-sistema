<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gamykla extends Model
{
    use HasFactory;

    protected $table = 'gamykla';
    protected $primaryKey = 'kodas';
    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'adresas','pavadinimas', 'fk_userId'
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
        return $this->hasOne(User::class, 'fk_userId', 'id');
    }

    public function worker(){
        return $this->hasMany(User::class, 'fk_gamykla', 'kodas');
    }
}
