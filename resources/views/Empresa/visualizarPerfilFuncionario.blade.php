@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Funcionário</h3>
        <h5>Dados Pessoais</h5>
        <input class="form-control" type="text" value="editar" name="acao" hidden>
        <div class="row">
            <div class="col-md-6">
                <label for='nome'>Nome</label>
                <input class="form-control" type="text" disabled name='nome' value="{{$funcionario->nome }}">
            </div>
            <div class="col-md-3">
            <label for='cpf'>CPF</label>
                <input class="form-control" type="text" disabled name='cpf' value="{{$funcionario->cpf }}">
            </div>
        </div>
        <br/>
        <h5>Dados de Contato</h5>
        <div class="row">
            <div class="col-md-6">
                <label for='email'>E-mail</label>
                <input class="form-control" type="text" disabled name='email' value="{{$funcionario->user->email}}">
            </div>
            <div class="col-md-6">
                <?php
                $telefones = "";
                foreach ($funcionario->telefonesFuncionario as $item) {
                    $telefones.=$item->numero.", ";
                }
                ?>
                <label for='telefones'>Telefones * (Separados por vírgula)</label>
                <input class="form-control" type="text" disabled name='telefones' value="{{$telefones }}">
            </div>
        </div>
        <br/>
        <h5>Dados Bancários</h5>
        <div class="row">
            <div class="col-md-6">
                <label for='banco'>Banco</label>
                <input class="form-control" type="text" disabled name='banco' value="{{$funcionario->contaBancariaFuncionario->banco }}">
            </div>
            <div class="col-md-2">
                <label for='agencia'>Agência</label>
                <input class="form-control" type="text" disabled name='agencia' value="{{$funcionario->contaBancariaFuncionario->agencia }}">
            </div>
            <div class="col-md-2">
                <label for='numero'>Número da Conta</label>
                <input class="form-control" type="text" disabled name='numero' value="{{$funcionario->contaBancariaFuncionario->numero_conta }}">
            </div>
            <div class="col-md-2">
                <label for='variacao'>Variação da Conta</label>
                <input class="form-control" type="text" disabled name='variacao' value="{{$funcionario->contaBancariaFuncionario->variacao_conta }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for='descricao'>Descrição</label>
                {!! Form::textarea('descricao', $funcionario->contaBancariaFuncionario->descricao, ['class'=>'form-control', 'placeholder'=>'Descrição', 'rows'=>'3', 'disabled']) !!}
            </div>
        </div>
        <br/>
        <h5>Dados Profissionais</h5>
        <div class="row">
            <div class="col-md-3">
                <label for='cnpj_empresa'>CNPJ Empresa</label>
                <input class="form-control" type="text" disabled name='cnpj_empresa' value="{{$funcionario->empresa->cnpj }}">
            </div>
            <div class="col-md-5">
                <label for='empresa'>Nome da Empresa</label>
                <input class="form-control" type="text" disabled name='empresa' value="{{$funcionario->empresa->nome }}">
            </div>
            <div class="col-md-4">
                <label for='cargo'>Cargo</label>
                <input class="form-control" type="text" disabled name='cargo' value="{{$funcionario->cargo }}">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ url('/empresa/funcionarios') }}" class="btn btn-danger">Voltar</a>
                <a href="{{ url('/empresa/funcionarios/desativar/'.$funcionario->id) }}" class="btn btn-primary" onclick="return confirm('Tem certeza que deseja desativar este funcionário?')" >Desativar</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
