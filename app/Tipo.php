<?php

namespace Referentes;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $fillable = ['nombre'];
    
    public $timestamps = false;
    
    public function cambios(){
            return $this->hasMany('Referentes\Cambio');
    }
}
