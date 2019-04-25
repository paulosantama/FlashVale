<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function isAdmin(){
        if(\Auth::check() && \Auth::user()->type==2)return true;
        else return false;
    }
    public function menuAdmin(){
        if (!$this->isAdmin()) return \Redirect::to('login');

        return view('Admin.home');
    }
    public function telasolicitacoesEmpresa(){
        if (!$this->isAdmin()) return \Redirect::to('login');

        $solicitacoesEmpresa = Empresa::where('ativo','0')->get();
        return view('Admin.solicitacoesCadastroEmpresa',['solicitacoes'=>$solicitacoesEmpresa]);
    }
    public function getEmpresa($empresa){
        if (!$this->isAdmin()) return \Redirect::to('login');

        $empresaSol = Empresa::find($empresa);

        return view('Admin.VisualizarEmpresa',['empresa'=>$empresaSol]);
    }
    public function aprovarEmpresa($empresa){
        if (!$this->isAdmin()) return \Redirect::to('login');

        $empresaSol = Empresa::find($empresa);
        $empresaSol->aprovarCadastro();

        \Session::flash('mensagemSucesso','A Empresa foi Aprovada!');

        return \Redirect::to('admin/solicitacoesEmpresa');
    }
    public function reprovarEmpresa($empresa){
        if (!$this->isAdmin()) return \Redirect::to('login');

        $empresaSol = Empresa::find($empresa);
        $empresaSol->reprovarCadastro();

        \Session::flash('mensagemSucesso','A Empresa foi Reprovada!');

        return \Redirect::to('admin/solicitacoesEmpresa');
    }
}
