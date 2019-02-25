<?php

namespace App\Http\Controllers;

use App\ContaBancariaEmpresa;
use App\Empresa;
use App\Funcionario;
use App\SolicitacaoCadastro;
use App\User;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function telaCadastrar(){
        return view('Empresa.telaCadastrar');
    }
    public function homepage(){
        return view('Empresa.home');
    }
    public function getFuncionario($sol){
        $solicitacao = SolicitacaoCadastro::findOrfail($sol);
//        $funcionario = Funcionario::findOrFail($id);

        return view('Empresa.visualizarFuncionario', ['funcionario'=>$solicitacao->funcionario,'sol'=>$sol]);
    }
    public function salvar(Request $request){
        if($request->editar){
            $empresa = Empresa::find(\Auth::user()->empresa_id);
        }else{
            $empresa = new Empresa();
        }

        \DB::beginTransaction();
        try {
            $empresa->nome = $request->nome;
            $empresa->cnpj = $request->cnpj;

            $empresa->save();

            //telefone
            $listTelefones = explode(',', $request->telefones);
            $telefones = array();
            foreach ($listTelefones as $key => $telefone) {
                array_push($telefones, array('numero' => $telefone, 'descricao' => 'Telefone ' . ($key + 1)));
            }
            $empresa->telefonesEmpresa()->delete();
            $empresa->telefonesEmpresa()->createMany($telefones);

            //bancaria
            $conta = new ContaBancariaEmpresa();
            $conta->banco = $request->banco;
            $conta->agencia = $request->agencia;
            $conta->numero_conta = $request->numero;
            $conta->variacao_conta = $request->variacao;
            $conta->descricao = $request->descricao;

            $empresa->contasBancariasEmpresa()->delete();
            $empresa->contasBancariasEmpresa()->save($conta);

            //user
            $user = User::find(\Auth::user()->id);
            $user->empresa_id = $empresa->id;
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->type = 1;
            $user->save();
        }catch (\Exception $error){
            \DB::rollBack();
            \Session::flash('mensagem', 'Erro no Cadastro');

            if($request->editar){
                return Redirect('/empresa/editar')->withInput();
            }else{
                return Redirect('/empresa/cadastro')->withInput();
            }
        }
        \DB::commit();
        if($request->editar){
            \Session::flash('mensagemSucesso', 'Sucesso');
            return \Redirect::to(\url('/empresa/editar'));
        }else{
            return \Redirect::to('/empresa/home');
        }
    }
    public function editar(){
        try{
            $empresa = Empresa::findOrFail(\Auth::user()->empresa_id);
            return view('Empresa.telaEditar',['empresa'=>$empresa]);
        }catch(\Exception $error){
            \Session::flash('mensagem','ERRO');
            return \Redirect::to('home');
        }
    }
    public function solicitacoesCadastro(){
        if(!\Auth::check() || \Auth::user()->empresa_id == null){
            return \Redirect::to('login');
        }

        $empresa = Empresa::findOrFail(\Auth::user()->empresa_id);
        $solicitacoes = $empresa->solicitacoesCadastro;

        return view('Empresa.solicitacoesCadastro', ['solicitacoes'=>$solicitacoes]);
    }
    public function retornaEmpresa(){
        try{
            if (isset($_GET['cnpj'])){
                $empresa = Empresa::where('cnpj',$_GET['cnpj'])->firstOrFail();
                $valor['nome_empresa'] = $empresa->nome;
                $valor['valido'] = true;
            }
        }catch(\Exception $error){
            $valor['nome_empresa'] = "Empresa não encontrada";
            $valor['valido'] = false;
        }
        return json_encode($valor);
    }
}
