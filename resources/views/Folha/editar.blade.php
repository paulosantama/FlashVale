@extends('layouts.app')
@section('content')
    <div class="container">
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
            <?php
                $folha = $funcionario->folhaSalarialFuncionario()->orderBy('created_at','desc')->first();
            ?>
            <div class="col-md-3">
                {!! Form::label('salario_bruto_original','Salário Original(R$)') !!}
                {!! Form::input('text','salario_bruto_original',$folha->salario_bruto_original,['class'=>'form-control', 'id'=>'field_bruto','onkeydown'=>'changeBruto(event)']) !!}
            </div>
            <div class="col-md-3">
                {!! Form::label('salario_bruto_novo','Salário Atual(R$)') !!}
                {!! Form::input('text','salario_bruto_novo',$folha->salario_bruto_novo,['class'=>'form-control', 'id'=>'field_novo','readonly']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ url('folha/') }}" class="btn btn-danger">Cancelar</a>
                {!! Form::submit('Salvar',['class'=>'btn btn-success']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('script')
    <script>
        var valor_original = document.getElementById('field_bruto').value;
        valor_original = valor_original.replace(",",".");
        var novo_original = document.getElementById('field_novo').value;
        var diferenca = (parseFloat(valor_original)-parseFloat(novo_original));

        function changeBruto(tecla) {
            var valor = document.getElementById('field_bruto').value;

            // backspace
            if (tecla.keyCode == 8){
                valor = valor.substr(0,(valor.length - 1));
            }else{
                if (valor.length==0){
                    valor = tecla.key.toString();
                }else{
                    valor = valor + tecla.key.toString();
                }
            }
            valor = valor.replace(",",".");
            // console.log(valor);
            // console.log(tecla);
            var novo = document.getElementById('field_novo');

            novo.value = (parseFloat(valor)-diferenca);
        }
    </script>
@endsection
