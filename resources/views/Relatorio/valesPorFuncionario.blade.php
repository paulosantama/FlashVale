@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Vales por Funcionário</h3>
        <br/>
        @if(Session::has('mensagem'))
            <div class="alert alert-danger">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        <br/>
        {!! Form::open(['url'=>'/empresa/relatorios/ValesPorFuncionario/pdf']) !!}
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="funcionario">Nome do Funcionário:</label>
                            {!! Form::select('funcionario',$funcionarios,null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="dataInicial">Data Inicial</label>
                            {!! Form::input('date','dataInicial',null,['class'=>'form-control','required']) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="dataFinal">Data Final</label>
                            {!! Form::input('date','dataFinal',null,['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="status">Status</label>
                            {!! Form::select('status',$status, null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12" style="text-align: right;">
                            <a href="{{ url('/empresa/relatorios') }}" class="btn btn-danger">Voltar</a>
                            <input type="submit" class="btn btn-primary" value="Gerar Relatório"/>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection