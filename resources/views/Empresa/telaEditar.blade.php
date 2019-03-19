@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('mensagem'))
            <div class="alert alert-danger">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        <h3>Empresa</h3>
        <h5>Dados Empresariais</h5>
        {!! Form::open(['url'=>'empresa/atualizar']) !!}
        <input type="text" value="editar" name="editar" hidden>
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('nome','Nome *') !!}
                {!! Form::input('text', 'nome', $empresa->nome , ['class'=>'form-control','required','autofocus', 'placeholder'=>'Nome']) !!}
            </div>
            <div class="col-md-3">
                {!! Form::label('cnpj','CNPJ *') !!}
                {!! Form::input('text', 'cnpj', $empresa->cnpj, ['class'=>'form-control','required' ,'placeholder'=>'CNPJ']) !!}
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
                foreach ($empresa->telefonesEmpresa as $item) {
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
                {{--{!! Form::input('text', 'banco', $empresa->contasBancariasEmpresa->banco, ['class'=>'form-control','required', 'placeholder'=>'Banco']) !!}--}}
                {!! Form::select('banco', ['Banco do Brasil' => 'Banco do Brasil', 'Bradesco' => 'Bradesco', 'Caixa Econômica' => 'Caixa Econômica', 'Itaú' => 'Itaú', 'Santander' => 'Santander', 'HSBC' => 'HSBC', 'Sicoob' => 'Sicoob'], $empresa->contasBancariasEmpresa->banco, ['class'=>'form-control','required','placeholder'  => 'Informe o Banco...']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('agencia','Agência *') !!}
                {!! Form::input('text', 'agencia', $empresa->contasBancariasEmpresa->agencia, ['class'=>'form-control','required', 'placeholder'=>'Agência']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('numero','Número da Conta *') !!}
                {!! Form::input('text', 'numero', $empresa->contasBancariasEmpresa->numero_conta, ['class'=>'form-control','required', 'placeholder'=>'Número da Conta']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('variacao','Variação da Conta *') !!}
                {!! Form::input('text', 'variacao', $empresa->contasBancariasEmpresa->variacao_conta, ['class'=>'form-control','required', 'placeholder'=>'Variação da Conta']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                {!! Form::label('descricao','Descrição') !!}
                {!! Form::textarea('descricao', $empresa->contasBancariasEmpresa->descricao, ['class'=>'form-control', 'placeholder'=>'Descrição', 'rows'=>'3']) !!}
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ url('/empresa/home') }}" class="btn btn-danger">Voltar</a>
                {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/libraries/jquery.js') }}"></script>
    {{--<script src="{{ asset('js/libraries/jquery.inputmask.bundle.js') }}" defer></script>--}}
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js" defer></script>
    <script>
        $(document).ready(function(){
            $("#cnpj").inputmask("99.999.999/9999-99");
            $("#agencia").inputmask("9{1,6}-9");
            $("#numero").inputmask("9{1,10}");
            $("#variacao").inputmask("9{1,3}");
            // $("#telefones").inputmask("((9{0,2})9{4,5}-9999, ){0,4}");
        });
    </script>
@endsection