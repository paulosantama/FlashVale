@extends('layouts.app')
@section('content')
    <div class="container">
        <?php
            $folha = $funcionario->folhaSalarialFuncionario->first();
        ?>
        @if(is_null($folha))
            <?php
                Session::flash('mensagem','ERRO: Folha Salarial não cadastrada para o período.');
            ?>
            <script>
                window.location.href="{{ url('/funcionario/home') }}";
            </script>
        @else
            {!! Form::open(['url'=>'folha/salvar']) !!}
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="editar" value="editar" hidden/>
                    {!! Form::input('text','idFunc', $funcionario->id, ['class'=>'form-control', 'hidden']) !!}
                    {!! Form::label('nome','Funcionário') !!}
                    {!! Form::input('text','nome',$funcionario->nome,['class'=>'form-control','disabled']) !!}
                    {{--<input type="text" onchange="">--}}
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-3">
                    {!! Form::label('salario_bruto_original','Salário Original(R$)') !!}
                    {!! Form::input('text','salario_bruto_original',$folha->salario_bruto_original,['class'=>'form-control', 'id'=>'field_bruto','onchange'=>'changeBruto()', 'readonly']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::label('salario_bruto_novo','Salário Atual(R$)') !!}
                    {!! Form::input('text','salario_bruto_novo',$folha->salario_bruto_novo,['class'=>'form-control', 'id'=>'field_novo','readonly']) !!}
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{ url('funcionario/home') }}" class="btn btn-danger">Voltar</a>
                </div>
            </div>
            {!! Form::close() !!}
        @endif
    </div>
@endsection
