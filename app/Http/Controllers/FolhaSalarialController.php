<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\FolhaSalarial;
use App\Funcionario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FolhaSalarialController extends Controller
{
    public function renovarFolha(){
        try{
            if(!\Auth::check() || \Auth::user()->empresa_id == null){
                return \Redirect::to('login');
            }

            $empresa = Empresa::findOrFail(\Auth::user()->empresa_id);
            $funcsEmpresa = $empresa->funcionariosEmpresa->where('ativo',1);

            $countRenovacoes = 0;
            $mesAtual = now()->startOfMonth();

            foreach ($funcsEmpresa as $key => $func ) {
                $folha = $func->folhaSalarialFuncionario()->orderBy('created_at','DESC')->first();
                if ($folha->created_at->lt($mesAtual)){
                    $folhaNova = new FolhaSalarial();
                    $folhaNova->funcionario_id = $func->id;
                    $folhaNova->salario_bruto_original = $folha->salario_bruto_original;
                    $folhaNova->salario_bruto_novo = $folha->salario_bruto_original;

                    $folhaNova->save();
                    $countRenovacoes++;
                }
            }

            if ($countRenovacoes>0){
                \Session::flash('mensagemSucesso','Folha salarial renovada com sucesso.');
            }else{
                \Session::flash('mensagemSucesso','Nenhuma folha para renovar.');
            }
        }catch (\Exception $error){
            \Session::flash('mensagem','Erro na renovação da folha salarial.');
//            echo $error->getMessage();
        }
        return \Redirect::to('folha/');
    }
    public function listar(){
        if(!\Auth::check()){
            return \Redirect::to('login');
        }

        $empresa = Empresa::findOrFail(\Auth::user()->empresa_id);
        $funcionarios = $empresa->funcionariosEmpresa()->where('ativo',1)->orderBy('nome','ASC')->get();

        $folhas = [];

        foreach ($funcionarios as $func){
            foreach ($func->folhaSalarialFuncionario as $folha) {
                array_push($folhas, $folha);
            }
        }

        return view('Folha.listar',['folhas'=>$folhas]);
//        return view('Folha.listar',['funcionarios'=>$funcionarios]);
    }
    public function cadastrar($func){
        if(!\Auth::check()){
            return \Redirect::to('login');
        }
        return view('Folha.cadastrar',['func'=>$func]);
    }
    public function salvar(Request $request){
        if(!\Auth::check()){
            return \Redirect::to('login');
        }
        try{
            if($request->editar){
                $folha = FolhaSalarial::where('funcionario_id',$request->idFunc)->first();
                $folha->salario_bruto_original = $request->salario_bruto_original;
                $folha->salario_bruto_novo = $request->salario_bruto_novo;
            }else{
                $folha = new FolhaSalarial();
                $folha->funcionario_id = $request->idFunc;
                $folha->salario_bruto_original = $request->salario_bruto_original;
                $folha->salario_bruto_novo = $request->salario_bruto_original;
            }
            $folha->save();

            \Session::flash('mensagemSucesso','Folha salarial cadastrada com sucesso.');
        }catch (\Exception $error){
            \Session::flash('mensagem','Erro no cadastro da folha salarial.');
//            echo $error->getMessage();
        }
        return \Redirect::to('folha/');
    }
    public function editar($func){
        if(!\Auth::check()){
            return \Redirect::to('login');
        }
        $funcionario = Funcionario::findOrFail($func);

        return view('Folha.editar',['funcionario'=>$funcionario]);
    }
    public function visualizar($func){
        if(!\Auth::check()){
            return \Redirect::to('login');
        }
        $funcionario = Funcionario::findOrFail($func);

        return view('Folha.visualizar',['funcionario'=>$funcionario]);
    }
}
