<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password', 'userlevel','fk_gamykla','atlyginimas','salis','miestas','gatve','buto_nr','duru_kodas'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tvarkarasciai(){
        return $this->hasMany(Tvarkarastis::class, 'fk_darbuotojasId');
    }

    public function tvarkarasciaiBoss(){
        return $this->hasMany(Tvarkarastis::class, 'fk_vadovasId');
    }

    public function gamyklaBoss()
    {
        return $this->hasOne(Gamykla::class, 'fk_userId', 'id');
    }

    public function gamykla()
    {
        return $this->hasOne(Gamykla::class, 'kodas', 'fk_gamykla');
    }


}
