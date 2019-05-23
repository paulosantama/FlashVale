<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\FolhaSalarial;
use App\Funcionario;
use App\SolicitacaoVale;
use Illuminate\Http\Request;

class SolicitacaoValeController extends Controller
{
    public function telaSolicitacoes(){
        if(!\Auth::check()){
            return \Redirect::to('login');
        }
        $tipo = \Auth::user()->type;
        if ($tipo==0){
            $funcionario = Funcionario::find(\Auth::user()->funcionario_id);
            $solVales = $funcionario->solicitacoesValeFuncionario()->orderBy('created_at','DESC')->get();
        }else{
            $empresa = Empresa::find(\Auth::user()->empresa_id);
            $solVales = $empresa->solicitacoesValeEmpresa()->orderBy('created_at','DESC')->get();
        }

        return view('Vale.solicitacao',['solicitacoes'=>$solVales, 'tipoUser'=>$tipo]);
    }
    public function salvar(Request $request){
        try{
            $solVale = new SolicitacaoVale();

            $solVale->empresa_id = $request->empresa_id;
            $solVale->funcionario_id = $request->funcionario_id;
            $solVale->valor_solicitado = $request->valor;
            $solVale->status_vale_id = 1;

            $func = Funcionario::findOrFail($request->funcionario_id);
            $folha = $func->folhaSalarialFuncionario()->orderBy('created_at','DESC')->first();

            $mesAtual = now()->startOfMonth();

            if ($folha->created_at->lt($mesAtual)){
                \Session::flash('mensagem','Folha Salarial desatualizada, entrar em contato com a empresa.');
                return \Redirect::to("/vale/solicitar")->withInput();
            }

            $solsMensais = $func->solicitacoesValeFuncionario->where('created_at','>=', $mesAtual);
            $sumValSolsMensais = 0;
            foreach ($solsMensais as $sol){
                $sumValSolsMensais+= $sol->valor_solicitado;
            }

            $disponivel = 400 - $sumValSolsMensais;

            if ($disponivel<=0){
                \Session::flash('mensagem','O limite de solicitações foi esgotado para o mês atual.');
                return \Redirect::to("/vale/solicitar")->withInput();
            }

            if ($request->valor > $disponivel){
                \Session::flash('mensagem','O valor solicitador excede o disponível para o mês.');
                return \Redirect::to("/vale/solicitar")->withInput();
            }

            if ($request->valor > $folha->salario_bruto_novo){
                \Session::flash('mensagem','O valor solicitador excede o disponível em folha.');
                return \Redirect::to("/vale/solicitar")->withInput();
            }

            $solVale->folha_id = $folha->id;
            $solVale->save();

            \Session::flash('mensagemSucesso','Solicitação de vale efetuada, aguarde a aprovação.');
            return \Redirect::to('vale/solicitacoes');
        }catch (\Exception $error){
            \Session::flash('mensagem','Erro na solicitação de vale.');
            return \Redirect::to('/vale/solicitar');
        }
    }
    public function telaSolicitar(){
        if(!\Auth::check() || \Auth::user()->funcionario_id == null){
            return \Redirect::to('login');
        }
//        $tipo = \Auth::user()->type;
        $funcionario = \App\Funcionario::findOrFail(\Auth::user()->funcionario_id);
        $folha = $funcionario->folhaSalarialFuncionario()->orderBy('created_at','DESC')->first();

        $mesAtual = now()->startOfMonth();
        $solsMensais = $funcionario->solicitacoesValeFuncionario->where('created_at','>=', $mesAtual)->where('status_vale_id','<>','3');
        $sumValSolsMensais = 0;
        foreach ($solsMensais as $sol){
            $sumValSolsMensais+= $sol->valor_solicitado;
        }
        $disponivel = 400 - $sumValSolsMensais;

        return view('Vale.telaSolicitar',['folha'=>$folha, 'funcionario'=>$funcionario, 'disponivel'=>$disponivel]);
    }
    public function aprovar($val){
        if (\Auth::user()->type==1){
            \DB::beginTransaction();
            try{
                $solicitacao = \App\SolicitacaoVale::findOrFail($val);
                $folha = FolhaSalarial::findOrFail($solicitacao->folha_id);

                $mesAtual = now()->startOfMonth();

                if ($folha->created_at->lt($mesAtual)){
                    \Session::flash('mensagem','Somente é possível aprovar Vales de Folhas Atualizadas.');
                    return \Redirect::to("vale/solicitacoes");
                }
                if ($solicitacao->valor_solicitado > $folha->salario_bruto_novo){
                    \Session::flash('mensagem','O valor solicitador excede o disponível em folha.');
                    return \Redirect::to("vale/solicitacoes");
                }

                $solicitacao->status_vale_id = 2;
                $solicitacao->save();

                $folha->salario_bruto_novo = ($folha->salario_bruto_novo - $solicitacao->valor_solicitado);
                $folha->save();

                \DB::commit();
                \Session::flash('mensagemSucesso','Solicitação de vale aprovada.');
                return \Redirect::to('vale/solicitacoes');
            }catch (\Exception $error){
                \DB::rollBack();
                \Session::flash('mensagem','Erro na execução da ação.');
                return \Redirect::to('vale/solicitacoes');
            }
        }else{
            return \Redirect::to('login');
        }
    }
    public function reprovar($val){
        if (\Auth::user()->type==1){
            try{
                $solicitacao = SolicitacaoVale::findOrFail($val);
                $solicitacao->status_vale_id = 3;
                $solicitacao->save();
            }catch (\Exception $error){
                \Session::flash('mensagem','Erro na execução da ação.');
                return \Redirect::to('vale/solicitacoes');
            }
            \Session::flash('mensageSucesso','Solicitação de vale reprovada.');
            return \Redirect::to('vale/solicitacoes');
        }else{
            return \Redirect::to('login');
        }
    }
}
