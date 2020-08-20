<?php

namespace App\Http\Controllers;

use App\Funcionario;
use Illuminate\Http\Request;

class FuncionarioControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $func = Funcionario::all();
        return $func->toJson();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $func = new Funcionario();
        $func->nome = $request->input('nome');
        $func->funcao = $request->input('funcao');
        $func->salario = $request->input('salario');
        $func->save();
        return $func->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $func = Funcionario::find($id);
        if(isset($func)){
            return $func->toJson();
        }
        return response('erro', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $func = Funcionario::find($id);
        if(isset($func)){
            $func->nome = $request->input('nome');
            $func->funcao = $request->input('funcao');
            $func->salario = $request->input('salario');
            $func->save();
            return $func->toJson();
        }
        return response('erro', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $func = Funcionario::find($id);
        if(isset($func)){
            $func->delete();
            return response('ok', 200);
        }
        return response('erro', 404);
    }
}
