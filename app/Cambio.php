<?php

namespace Referentes;

use Illuminate\Database\Eloquent\Model;

class Cambio extends Model
{
    protected $fillable = ['referente_id', 'user_id', 'lengua_id', 'tipo_id', 'palabra', 'definicion', 'anno_testimonio', 'siglo'];
    
    public function referente() {
        return $this->belongsTo('Referentes\Referente');
    }

    public function user() {
        return $this->belongsTo('Referentes\User');
    }

    public function lengua() {
        return $this->belongsTo('Referentes\Lengua');
    }

    public function tipo() {
        return $this->belongsTo('Referentes\Tipo');
    }

    public function getSigloFromAnno(){
        return  ($this->anno / 100) +1;
    }

    public function getSiglo()
    {
     // Convert the integer into an integer (just to make sure)
     $integer = intval($this->siglo);
     $result = '';
     
     // Create a lookup array that contains all of the Roman numerals.
     $lookup = array('M' => 1000,
     'CM' => 900,
     'D' => 500,
     'CD' => 400,
     'C' => 100,
     'XC' => 90,
     'L' => 50,
     'XL' => 40,
     'X' => 10,
     'IX' => 9,
     'V' => 5,
     'IV' => 4,
     'I' => 1);
     
     foreach($lookup as $roman => $value){
      // Determine the number of matches
      $matches = intval($integer/$value);
     
      // Add the same number of characters to the string
      $result .= str_repeat($roman,$matches);
     
      // Set the integer to be the remainder of the integer and the value
      $integer = $integer % $value;
     }
     
     // The Roman numeral should be built, return it
     return $result;
    }
}
