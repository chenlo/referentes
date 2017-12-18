<?php

namespace Referentes;

use Illuminate\Database\Eloquent\Model;

class Recategorizacion extends Model
{
    
    public $table = "recategorizacions";

    public $timestamps = false;

    protected $fillable = ['cambio_id', 'inicial_categoria_id', 'final_categoria_id'];

    public function cambio()
    {
        return $this->belongsTo('Referentes\Cambio');
    }

    public function inicialCategoria(){
        return $this->belongsTo('Referentes\InicialCategoria');
    }

    public function finalCategoria(){
        return $this->belongsTo('Referentes\FinalCategoria');
    }
}
