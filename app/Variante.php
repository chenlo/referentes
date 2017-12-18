<?php

namespace Referentes;

use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
	public $table = "variantes";
	
	public $timestamps = false;

    protected $fillable = ['referente_id', 'palabra'];

    public function referente() {
      	return $this->belongsTo('Referentes\Referente');
    }

}
