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

            $solVale->save();
        }catch (\Exception $error){
            \Session::flash('mensagem','Erro na solicitação de vale.');
            return \Redirect::to('/vale/solicitar');
            echo $error->getMessage();
        }
        \Session::flash('mensagemSucesso','Solicitação de vale efetuada, aguarde a aprovação.');
        return \Redirect::to('/funcionario/home');
    }
    public function telaSolicitar(){
        $tipo = \Auth::user()->type;
        return view('Vale.telaSolicitar');
    }
    public function aprovar($val){
        if (\Auth::user()->type==1){
            \DB::beginTransaction();
            try{
                $solicitacao = SolicitacaoVale::findOrFail($val);
                $solicitacao->status_vale_id = 2;
                $solicitacao->save();

                $folha = FolhaSalarial::where('funcionario_id',$solicitacao->funcionario_id)->first();
                $folha->salario_bruto_novo = ($folha->salario_bruto_novo - $solicitacao->valor_solicitado);
                $folha->save();
            }catch (\Exception $error){
                \DB::rollBack();
                \Session::flash('mensagem','Erro na execução da ação.');
                echo $error->getMessage();
                return \Redirect::to('vale/solicitacoes');
            }
            \Session::flash('mensagemSucesso','Solicitação de vale aprovada.');
            \DB::commit();
            return \Redirect::to('vale/solicitacoes');
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
        }
    }
}
