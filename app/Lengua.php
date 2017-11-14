<?php

namespace Referentes;

use Illuminate\Database\Eloquent\Model;

class Lengua extends Model
{
    
    protected $fillable = ['nombre'];

    public $timestamps = false;
    
    public function usuarios(){
		  return $this->hasMany('Referentes\User');
    }

    public function cambios(){
        return $this->hasMany('Referentes\Cambio');
    }
}
