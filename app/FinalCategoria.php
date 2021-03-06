<?php

namespace Referentes;

use Illuminate\Database\Eloquent\Model;

class FinalCategoria extends Model
{
    protected $fillable = ['palabra'];
    
    public $timestamps = false;
    
    public function recategorizacions() {
      	return $this->hasMany('Referentes\Recategorizacion');
    }
}
