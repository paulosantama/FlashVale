@extends('layouts.app')
@section('content')
    <div class="container">
        {!! Form::open(['url'=>'folha/salvar']) !!}
        <div class="row">
            <div class="col-md-6">
                {!! Form::input('text','idFunc', $func, ['class'=>'form-control', 'hidden']) !!}
                {!! Form::label('nome','Funcionário') !!}
                <?php
                    $funcionario = \App\Funcionario::findOrFail($func);
                ?>
                {!! Form::input('text','nome',$funcionario->nome,['class'=>'form-control', 'readonly']) !!}
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-3">
                {!! Form::label('salario_bruto_original','Salário Bruto(R$)') !!}
                {!! Form::input('text','salario_bruto_original',null,['class'=>'form-control']) !!}
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ url('folha/') }}" class="btn btn-danger">Cancelar</a>
                {!! Form::submit('Salvar',['class'=>'btn btn-success']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
