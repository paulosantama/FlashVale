<?php

namespace App\Http\Controllers;

use App\Funcionario;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function GenerateValesPorFuncionarioPdf(){
        $fund = Funcionario::all();
        return \PDF::loadView('Relatorio.pdfValesPorFuncionario', compact('fund'))->stream();
    }
}
