<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table= "departamentos";

    public function funcionarios() {
        return $this->belongsToMany('App\Funcionario', 'alocacaos');
    }
}
