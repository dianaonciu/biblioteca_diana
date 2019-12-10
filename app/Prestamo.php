<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    public function Usuario(){
        return $this->hasOne('App\Usuario', 'id', 'usuario_id');
    }

    public function Libro(){
        return $this->hasOne('App\Libro', 'id', 'libro_id');
    }
}
