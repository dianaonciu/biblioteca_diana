<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    public function Usuarios(){
        return $this->hasMany('App\Usuario');
    }
   
}
