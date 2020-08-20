<?php

namespace App\Http\Controllers;

use App\Alocacao;
use App\Departamento;
use Illuminate\Http\Request;

class AlocacaoController extends Controller
{

    public function store(Request $request) {
        $dep = Departamento::find($request->input('departamento_id'));
        if(isset($dep)){
            $dep->funcionarios()->attach($request->input('funcionario_id'));
        }
    }

    public function destroy(Request $request) {
        $dep = Departamento::find($request->input('departamento_id'));
        if(isset($dep)){
            $dep->funcionarios()->detach($request->input('funcionario_id'));
            return response('ok', 202);
        }
        return response('erro', 404);
    }
}
