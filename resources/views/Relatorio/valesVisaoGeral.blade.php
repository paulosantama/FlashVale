@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Vales Visão Geral</h3>
        <br/>
        @if(Session::has('mensagem'))
            <div class="alert alert-danger">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        <br/>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="row">
                    <div class="col-md-6">
                        <label for="dataInicial">Data Inicial</label>
                        <input type="date" name="dataInicial" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="dataFinal">Data Final</label>
                        <input type="date" name="dataFinal" class="form-control">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12" style="text-align: right;">
                        <a href="{{ url('/empresa/relatorios') }}" class="btn btn-danger">Voltar</a>
                        <button class=" btn btn-primary">Gerar Relatório</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection