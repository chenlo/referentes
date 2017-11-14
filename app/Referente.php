<?php

namespace Referentes;

use Illuminate\Database\Eloquent\Model;

class Referente extends Model
{
    protected $fillable = ['user_id', 'palabra', 'informacion_enciclopedica'];

    public function user() {
      	return $this->belongsTo('Referentes\User');
    }

    public function cambios(){
        return $this->hasMany('Referentes\Cambio');
    }
}
