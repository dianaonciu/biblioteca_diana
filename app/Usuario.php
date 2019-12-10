<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function Libros(){
        return $this->hasMany('App\Libro');
    }
}
