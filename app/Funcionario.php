<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionarios";
    public function departamentos() {
        return $this->belongsToMany('App\Departamento', 'alocacaos');
    }
}
