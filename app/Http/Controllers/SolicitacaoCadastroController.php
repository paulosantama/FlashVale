<?php

namespace App\Http\Controllers;

use App\SolicitacaoCadastro;
use Illuminate\Http\Request;

class SolicitacaoCadastroController extends Controller
{
    public function cadastroAprovar($sol){
        $solicitacao = SolicitacaoCadastro::findOrFail($sol);
        $solicitacao->aprovar();

        \Session::flash('mensagemSucesso','Cadastro Aprovado');
//        return \Redirect::to(\url('/empresa/funcionarios/solicitacoes'));
        return \Redirect::to(\url('folha/'.$solicitacao->funcionario_id.'/cadastrar'));
    }
    public function cadastroReprovar($sol){
        $solicitacao = SolicitacaoCadastro::findOrFail($sol);
        $solicitacao->reprovar();

        \Session::flash('mensagem','Cadastro Reprovado');
        return \Redirect::to(\url('/empresa/funcionarios/solicitacoes'));
    }
}
