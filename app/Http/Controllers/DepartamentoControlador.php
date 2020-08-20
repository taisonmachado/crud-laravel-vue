<?php

namespace App\Http\Controllers;

use App\Departamento;
use Illuminate\Http\Request;

class DepartamentoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::with('funcionarios')->get(); //retorna os departamentos já com o relacionamento dos funcionários
        return $departamentos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dep = new Departamento();
        $dep->nome = $request->input('nome');
        $dep->descricao = $request->input('descricao');
        $dep->save();
        return $dep->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dep = Departamento::find($id);
        if(isset($dep)){
            return $dep->toJson();
        }
        return response('departamento nao encontrado', 404);
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
        $dep = Departamento::find($id);
        if(isset($dep)){
            $dep->nome = $request->input('nome');
            $dep->descricao = $request->input('descricao');
            $dep->save();
            return $dep->toJson();
        }
        return response('produto nao encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dep = Departamento::find($id);
        if (isset($dep)) {
            $dep->delete();
            return response('OK', 200);
        }
        return response('Departamento não encontrado', 404);
    }
}
