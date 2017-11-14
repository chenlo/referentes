<?php

namespace Referentes;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Referentes\Referente;
use Referentes\Cambio;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lengua_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function referentes(){
        return $this->hasMany('Referentes\Referente');
    }

    public function cambios(){
        return $this->hasMany('Referentes\Cambio');
    }

    public function lengua() {
        return $this->belongsTo('Referentes\Lengua');
     }

    public function isAdmin()
    {
        return $this->getAttribute('is_admin');
    }

    public function getCountReferentes(){
        return $this->referentes()->count();
    }

    public function getCountCambios(){
        return $this->cambios()->count();
    }

    public function ownsReferente(Referente $referente) {
        return ($this->id == $referente->user_id) || $this->isAdmin();
    }

    public function ownsCambio(Cambio $cambio) {
        return ($this->id == $cambio->user_id) || $this->isAdmin();
    }

}
