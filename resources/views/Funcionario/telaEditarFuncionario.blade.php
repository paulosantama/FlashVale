@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('mensagem'))
            <div class="alert alert-danger">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        <h3>Funcionário</h3>
        <h5>Dados Pessoais</h5>
        {!! Form::open(['url'=>'funcionario/atualizar']) !!}
        <input type="text" value="editar" name="editar" hidden>
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('nome','Nome *') !!}
                {!! Form::input('text', 'nome', $funcionario->nome , ['class'=>'form-control','required','autofocus', 'placeholder'=>'Nome']) !!}
            </div>
            <div class="col-md-3">
                {!! Form::label('cpf','CPF *') !!}
                {!! Form::input('text', 'cpf', $funcionario->cpf, ['class'=>'form-control','required' ,'placeholder'=>'CPF']) !!}
            </div>
        </div>
        <br/>
        <h5>Dados de Contato</h5>
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('email','E-mail  *') !!}
                {!! Form::input('text', 'email', Auth::user()->email, ['class'=>'form-control','required', 'placeholder'=>'E-mail']) !!}
            </div>
            <div class="col-md-6">
                <?php
                $telefones = "";
                foreach ($funcionario->telefonesFuncionario as $item) {
                    $telefones.=$item->numero.", ";
                }
                $telefones = substr_replace($telefones, '', -2, -1);
                ?>
                {!! Form::label('telefones','Telefones * (Separados por vírgula)') !!}
                {!! Form::input('text', 'telefones', $telefones, ['class'=>'form-control','required', 'placeholder'=>'Telefone 1, Telefone 2']) !!}
            </div>
        </div>
        <br/>
        <h5>Dados Bancários</h5>
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('banco','Banco *') !!}
                {!! Form::input('text', 'banco', $funcionario->contaBancariaFuncionario->banco, ['class'=>'form-control','required', 'placeholder'=>'Banco']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('agencia','Agência *') !!}
                {!! Form::input('text', 'agencia', $funcionario->contaBancariaFuncionario->agencia, ['class'=>'form-control','required', 'placeholder'=>'Agência']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('numero','Número da Conta *') !!}
                {!! Form::input('text', 'numero', $funcionario->contaBancariaFuncionario->numero_conta, ['class'=>'form-control','required', 'placeholder'=>'Número da Conta']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('variacao','Variação da Conta *') !!}
                {!! Form::input('text', 'variacao', $funcionario->contaBancariaFuncionario->variacao_conta, ['class'=>'form-control','required', 'placeholder'=>'Variação da Conta']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                {!! Form::label('descricao','Descrição') !!}
                {!! Form::textarea('descricao', $funcionario->contaBancariaFuncionario->descricao, ['class'=>'form-control', 'placeholder'=>'Descrição', 'rows'=>'3']) !!}
            </div>
        </div>
        <br/>
        <h5>Dados Profissionais</h5>
        <div class="row">
            <div class="col-md-3">
                {!! Form::label('cnpj_empresa','CNPJ Empresa *') !!}
                {!! Form::input('text', 'cnpj_empresa', $funcionario->empresa->cnpj, ['class'=>'form-control','required',  'placeholder'=>'CNPJ Empresa', 'readonly']) !!}
            </div>
            <div class="col-md-5">
                {!! Form::label('empresa','Nome da Empresa *') !!}
                {!! Form::input('text', 'empresa', $funcionario->empresa->nome, ['class'=>'form-control','required',  'placeholder'=>'Nome da Empresa', 'readonly']) !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('cargo','Cargo *') !!}
                {!! Form::input('text', 'cargo', $funcionario->cargo, ['class'=>'form-control' ,'required', 'placeholder'=>'Cargo', 'readonly']) !!}
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{url('/funcionario/home')}}" class="btn btn-danger">Cancelar</a>
                {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
