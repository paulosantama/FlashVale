@extends('layouts.app')
@section('style')
    <style>
        .itemPrincipal {
            /*color: white;*/
            height: 100%;
            width: 100%;
            /*background-color: mediumseagreen;*/
            border-radius: 10px;
        }

        .ocultLink:link {
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h3>Relatórios</h3>
        <br/>
        @if(Session::has('mensagem'))
            <div class="alert alert-danger">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif

        <div class="row">
            <div class="col-md-2 col-6 mt-2" style="height: 150px;">
                <a href="{{ url('/empresa/relatorios/valesPorFuncionario') }}" class="ocultLink">
                    <div class="itemPrincipal navVerde text-center">
                        <table height="100%" width="100%">
                            <tr>
                                <td class="align-middle">
                                    <h5>
                                        Vales por Funcionário
                                    </h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-6 mt-2" style="height: 150px;">
                <a href="{{ url('/empresa/relatorios/valesPorPeriodo') }}" class="ocultLink">
                    <div class="itemPrincipal navVerde text-center">
                        <table height="100%" width="100%">
                            <tr>
                                <td class="align-middle">
                                    <h5>
                                        Vales por Período
                                    </h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-6 mt-2" style="height: 150px;">
                <a href="{{ url('/empresa/relatorios/valesVisaoGeral') }}" class="ocultLink">
                    <div class="itemPrincipal navVerde text-center">
                        <table height="100%" width="100%">
                            <tr>
                                <td class="align-middle">
                                    <h5>
                                        Vales Visão Geral
                                    </h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ url('empresa/home') }}" class="btn btn-danger">Voltar</a>
            </div>
        </div>
    </div>
@endsection