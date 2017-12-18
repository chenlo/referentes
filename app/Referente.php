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

    public function variantes(){
        return $this->hasMany('Referentes\Variante');
    }

    public function deleteCambios(){
        foreach ($this->cambios as $key => $cambio) {
            $cambio->delete();
        }
    }

    public function updateVariantes($variantes){
        foreach($variantes as $variante) {
            if(!empty($variante)){
                $this->variantes()->create(['palabra' => $variante]);
            }
        }
    }
    
    public function deleteVariantes(){
        foreach ($this->variantes as $key => $variante) {
            $variante->delete();
        }
    }
}
