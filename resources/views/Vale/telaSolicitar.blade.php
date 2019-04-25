@extends('layouts.app')
@section('content')
    <?php

    ?>
    <div class="container">
        @if(Session::has('mensagem'))
            <div class="alert alert-danger">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        @if(is_null($folha))
            <?php
            Session::flash('mensagem','ERRO: Folha Salarial não cadastrada para o período.');
            ?>
            <script>
                window.location.href="{{ url('/funcionario/home') }}";
            </script>
        @else
            <div class="row">
                <h3>Solicitar Vale</h3>
            </div>
            {!! Form::open(['url'=>'/vale/salvar']) !!}
            <input type="text" name="funcionario_id" value="{{ $funcionario->id }}" hidden/>
            <input type="text" name="empresa_id" value="{{ $funcionario->empresa_id }}" hidden/>
            <div class="row">
                <div class="col-md-6">
                    {!! Form::label('funcionario', "Nome do Funcionario") !!}
                    {!! Form::input('text','funcionario',$funcionario->nome, ['class'=>'form-control','disabled']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::label('empresa', "Nome da Empresa") !!}
                    {!! Form::input('text','empresa',$funcionario->empresa->nome, ['class'=>'form-control','disabled']) !!}
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-2">
                    {!! Form::label('valor', "Valor Disponível (R$)") !!}
                    {!! Form::input('number','valor_disponivel',$disponivel, ['class'=>'form-control', 'disabled']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::label('valor', "Valor Solicitado (R$)") !!}
                    {!! Form::input('number','valor',null, ['class'=>'form-control','id'=>'valor','required']) !!}
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{ url('/funcionario/home') }}" class="btn btn-danger">Cancelar</a>
                    {!! Form::submit('Solicitar',['class'=>'btn btn-success']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        @endif
    </div>
@endsection
@section('script')
    {{--<script src="{{ asset('js/libraries/jquery.js') }}"></script>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>--}}
    {{--<script src="{{ asset('js/libraries/maskMoney.js') }}"></script>--}}
    {{--<script>--}}
    {{--$(document).ready(function () {--}}
    {{--$('#valor').maskMoney();--}}
    {{--})--}}
    {{--</script>--}}
@endsection
