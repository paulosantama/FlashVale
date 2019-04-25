<?php

namespace App\Http\Controllers;

use App\ContaBancariaFuncionario;
use App\Empresa;
use App\Funcionario;
use App\SolicitacaoCadastro;
use App\User;
use Grpc\Server;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class FuncionarioController extends Controller
{
    public function telaCadastrar(){
        return view('Funcionario.telaCadastrarFuncionario');
    }
    public function homepage(){
        return view('Funcionario.home');
    }
    public function salvar(Request $request){
        if($request->editar){
            $funcionario = Funcionario::find(\Auth::user()->funcionario_id);
        }else{
            $funcionario = new Funcionario();
            $funcionario->ativo = false;
        }

        \DB::beginTransaction();

        try {
            $funcionario->nome = $request->nome;
            $funcionario->cpf = $request->cpf;
            $funcionario->cargo = $request->cargo;

            $funcionario->save();

            //telefone
            $listTelefones = explode(',', $request->telefones);
            $telefones = array();
            foreach ($listTelefones as $key => $telefone) {
                array_push($telefones, array('numero' => trim($telefone), 'descricao' => 'Telefone ' . ($key + 1)));
            }
            $funcionario->telefonesFuncionario()->delete();
            $funcionario->telefonesFuncionario()->createMany($telefones);

            //bancaria
            $conta = new ContaBancariaFuncionario();
            $conta->banco = $request->banco;
            $conta->agencia = $request->agencia;
            $conta->numero_conta = $request->numero;
            $conta->variacao_conta = $request->variacao;
            $conta->descricao = $request->descricao;

            $funcionario->contaBancariaFuncionario()->delete();
            $funcionario->contaBancariaFuncionario()->save($conta);

            //empresa
            $empresa = Empresa::where('cnpj', $request->cnpj_empresa)->first();
            $funcionario->empresa_id = $empresa->id;

            $funcionario->save();

            //user
            $user = User::find(\Auth::user()->id);
            $user->funcionario_id = $funcionario->id;
            $user->name = $request->nome;
            $user->email = $request->email;
            $user->save();

            if(!$request->editar) {
                $cadastro = new SolicitacaoCadastro();
                $cadastro->empresa_id = $funcionario->empresa_id;
                $cadastro->funcionario_id = $funcionario->id;
                $cadastro->save();
            }
        }catch (\Exception $error){
            \DB::rollBack();
            \Session::flash('mensagem', 'Erro no Cadastro');

            if($request->editar){
                return \Redirect::to(\url('/funcionario/editar'))->withInput();
            }else{
                return \Redirect::to(\url('/funcionario/cadastro'))->withInput();
            }
        }
        \DB::commit();
        if($request->editar){
            \Session::flash('mensagemSucesso', 'Sucesso');
            return \Redirect::to('/funcionario/editar');
        }else{
            return \Redirect::to('/funcionario/home');
        }
    }
    public function editar(){
        try{
            $funcionario = Funcionario::findOrFail(\Auth::user()->funcionario_id);
            return view('Funcionario/telaEditarFuncionario',['funcionario'=>$funcionario]);
        }catch(\Exception $error){
            \Session::flash('mensagem','ERRO');
        return \Redirect::to('home');
        }
    }
}
