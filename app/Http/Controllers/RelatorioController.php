<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\StatusVale;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function GenerateValesPorFuncionarioPdf(Request $request){
        try{
            if (!EmpresaController::isEmpresa()) return \Redirect::to('login');

            $func = Funcionario::find($request->funcionario);
            $startDate = $request->dataInicial;
            $endDate = $request->dataFinal;
            $status = $request->status;

            // exibir todos status
            if ($status > StatusVale::get()->count()){
                $solicitacoes = $func->solicitacoesValeFuncionario()->whereBetween('created_at', [$startDate,$endDate])->orderBy('created_at','desc')->get();
            }else{
                $solicitacoes = $func->solicitacoesValeFuncionario()->whereBetween('created_at', [$startDate,$endDate])->where('status_vale_id',$status)->orderBy('created_at','desc')->get();
            }

            if (count($solicitacoes) == 0){
                $solicitacoes = array();
            }

            $empresa = $func->empresa;

//            return \PDF::loadView('Relatorio.pdfValesPorFuncionario', compact("func","empresa","solicitacoes"))->stream();
            return view('Relatorio.pdfValesPorFuncionario',['func'=>$func,'empresa'=>$empresa,'solicitacoes'=>$solicitacoes]);
        }catch(\Exception $error){
//            \Session::flash('mensagem','ERRO');
            \Session::flash('mensagem',$error->getMessage());
            return \Redirect::to('/empresa/relatorios/valesPorFuncionario')->withInput();
        }
    }
}
