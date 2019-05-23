<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Funcionario;
use App\SolicitacaoVale;
use App\StatusVale;
use Barryvdh\DomPDF\PDF;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function GenerateValesPorFuncionarioPdf(Request $request)
    {
        try {
            if (!EmpresaController::isEmpresa()) return \Redirect::to('login');

            $func = Funcionario::find($request->funcionario);
            $startDate = $request->dataInicial;
            $endDate = $request->dataFinal;
            $status = $request->status;

            if ($endDate < $startDate) {
                \Session::flash('mensagem', "A data final não pode ser anterior a data inicial.");
                return \Redirect::to('/empresa/relatorios/valesPorFuncionario')->withInput();
            }

            // exibir todos status
            if ($status > StatusVale::get()->count()) {
                $solicitacoes = $func->solicitacoesValeFuncionario()->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->orderBy('created_at', 'desc')->get();
            } else {
                $solicitacoes = $func->solicitacoesValeFuncionario()->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->where('status_vale_id', $status)->orderBy('created_at', 'desc')->get();
            }

            if (count($solicitacoes) == 0) {
                $solicitacoes = new Collection();
            }

            $empresa = $func->empresa;
            $maskStartDate = \Carbon\Carbon::parse($startDate)->format('d-m-Y');
            $maskEndDate = \Carbon\Carbon::parse($endDate)->format('d-m-Y');

            return \PDF::loadView('Relatorio.pdfValesPorFuncionario', compact("func", "empresa", "solicitacoes", "startDate", "endDate"))->download($func->nome . " (" . $maskStartDate . " até " . $maskEndDate . ")" . ".pdf");
//            return view('Relatorio.pdfValesPorFuncionario',['func'=>$func,'empresa'=>$empresa,'solicitacoes'=>$solicitacoes,'startDate'=>$startDate, 'endDate'=>$endDate]);
        } catch (\Exception $error) {
            \Session::flash('mensagem','ERRO na geração do relatório.');
//            \Session::flash('mensagem', $error->getMessage());
            return \Redirect::to('/empresa/relatorios/valesPorFuncionario')->withInput();
        }
    }

    public function GenerateValesPorPeriodoPdf(Request $request)
    {
        try {
            if (!EmpresaController::isEmpresa()) return \Redirect::to('login');

            $startDate = $request->dataInicial;
            $endDate = $request->dataFinal;
            $status = $request->status;

            if ($endDate < $startDate) {
                \Session::flash('mensagem', "A data final não pode ser anterior a data inicial.");
                return \Redirect::to('/empresa/relatorios/valesPorFuncionario')->withInput();
            }

            // exibir todos status
            if ($status > StatusVale::get()->count()) {
                $solicitacoes = SolicitacaoVale::whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->orderBy('created_at', 'desc')->get();
            } else {
                $solicitacoes = SolicitacaoVale::whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->where('status_vale_id', $status)->orderBy('created_at', 'desc')->get();
            }

            if (count($solicitacoes) == 0) {
                $solicitacoes = new Collection();
            }

            $empresa = Empresa::find(\Auth::user()->empresa_id);
            $maskStartDate = \Carbon\Carbon::parse($startDate)->format('d-m-Y');
            $maskEndDate = \Carbon\Carbon::parse($endDate)->format('d-m-Y');

            return \PDF::loadView('Relatorio.pdfValesPorPeriodo', compact("empresa", "solicitacoes", "startDate", "endDate"))->download($empresa->nome . " (" . $maskStartDate . " até " . $maskEndDate . ")" . ".pdf");
//            return view('Relatorio.pdfValesPorPeriodo',['empresa'=>$empresa,'solicitacoes'=>$solicitacoes,'startDate'=>$startDate, 'endDate'=>$endDate]);
        } catch (\Exception $error) {
            \Session::flash('mensagem','ERRO na geração do relatório.');
//            \Session::flash('mensagem', $error->getMessage());
            return \Redirect::to('/empresa/relatorios/valesPorPeriodo')->withInput();
        }
    }

    public function GenerateValesVisaoGeralShow(Request $request)
    {
        try {
            if (!EmpresaController::isEmpresa()) return \Redirect::to('login');

            $startDate = $request->dataInicial;
            $endDate = $request->dataFinal;

            $empresa = Empresa::find(\Auth::user()->empresa_id);

            $solicitacoes = $empresa->solicitacoesValeEmpresa()->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->get();

            if (count($solicitacoes) == 0) {
                $solicitacoes = new Collection();
            }

//            $solicitacoes->load('funcionario');
//            $solicitacoes->load('StatusVale');

            $qtd_solicitacoes = count($solicitacoes);
            $qtd_solicitacoes_analise = count($solicitacoes->where('status_vale_id','1'));
            $qtd_solicitacoes_aprovadas = count($solicitacoes->where('status_vale_id','2'));
            $qtd_solicitacoes_reprovadas = count($solicitacoes->where('status_vale_id','3'));

            $funcionarios = $empresa->funcionariosEmpresa;

            $funcVales = array();

            foreach ($funcionarios as $key => $func){
                array_push($funcVales,array('nome' => $func->nome, 'qtd' => count($func->solicitacoesValeFuncionario->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"]))));
            }

            $qtd_funcionarios = count($funcionarios);

            $arrayEstatisticas = array(
                'qtd_solicitacoes'=>$qtd_solicitacoes,
                'qtd_solicitacoes_analise'=>$qtd_solicitacoes_analise,
                'qtd_solicitacoes_aprovadas'=>$qtd_solicitacoes_aprovadas,
                'qtd_solicitacoes_reprovadas'=>$qtd_solicitacoes_reprovadas,
                'qtd_funcionarios' =>$qtd_funcionarios);

            $maskStartDate = \Carbon\Carbon::parse($startDate)->format('d-m-Y');
            $maskEndDate = \Carbon\Carbon::parse($endDate)->format('d-m-Y');

            return view('Relatorio.pdfValesVisaoGeral', [
                'empresa' => $empresa,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'estatisticas'=>$arrayEstatisticas,
                'StatFuncvales'=>$funcVales]);

        } catch (\Exception $error) {
            \Session::flash('mensagem','ERRO na geração do relatório.');
//            \Session::flash('mensagem', $error->getMessage());
            return \Redirect::to('/empresa/relatorios/valesVisaoGeral')->withInput();
        }
    }
}
