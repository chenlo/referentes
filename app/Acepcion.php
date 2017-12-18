<?php

namespace Referentes;

use Illuminate\Database\Eloquent\Model;

class Acepcion extends Model
{
	public $table = "acepcions";
	
	public $timestamps = false;

    protected $fillable = ['cambio_id', 'palabra'];

    public function referente() {
      	return $this->belongsTo('Referentes\Cambio');
    }

}
