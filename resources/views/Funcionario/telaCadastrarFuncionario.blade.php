@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('mensagem'))
            <div class="alert alert-danger">{{Session::get('mensagem')}}</div>
            {{--{!! Form::model() !!}--}}
        @else
        {{--{!! Form::open(['url'=>'funcionario/salvar']) !!}--}}
        @endif
        <h3>Funcionário</h3>
        <h5>Dados Pessoais</h5>
        {!! Form::open(['url'=>'funcionario/salvar']) !!}
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('nome','Nome *') !!}
                {!! Form::input('text', 'nome', Auth::user()->name , ['class'=>'form-control','required','autofocus', 'placeholder'=>'Nome']) !!}
            </div>
            <div class="col-md-3">
                {!! Form::label('cpf','CPF *') !!}
                {!! Form::input('text', 'cpf', null, ['class'=>'form-control','required' ,'placeholder'=>'CPF']) !!}
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
                {!! Form::label('telefones','Telefones * (Separados por vírgula)') !!}
                {!! Form::input('text', 'telefones', null, ['class'=>'form-control','required', 'placeholder'=>'Telefone 1, Telefone 2']) !!}
            </div>
        </div>
        <br/>
        <h5>Dados Bancários</h5>
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('banco','Banco *') !!}
                {{--{!! Form::input('text', 'banco', null, ['class'=>'form-control','required', 'placeholder'=>'Banco']) !!}--}}
                {!! Form::select('banco', ['Banco do Brasil' => 'Banco do Brasil', 'Bradesco' => 'Bradesco', 'Caixa Econômica' => 'Caixa Econômica', 'Itaú' => 'Itaú', 'Santander' => 'Santander', 'HSBC' => 'HSBC'], null, ['class'=>'form-control','required','placeholder'  => 'Informe o Banco...']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('agencia','Agência *') !!}
                {!! Form::input('text', 'agencia', null, ['class'=>'form-control','required', 'placeholder'=>'Agência']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('numero','Número da Conta *') !!}
                {!! Form::input('text', 'numero', null, ['class'=>'form-control','required', 'placeholder'=>'Número da Conta']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('variacao','Variação da Conta *') !!}
                {!! Form::input('text', 'variacao', null, ['class'=>'form-control','required', 'placeholder'=>'Variação da Conta']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                {!! Form::label('descricao','Descrição') !!}
                {!! Form::textarea('descricao', null, ['class'=>'form-control', 'placeholder'=>'Descrição', 'rows'=>'3']) !!}
            </div>
        </div>
        <br/>
        <h5>Dados Profissionais</h5>
        <div class="row">
            <div class="col-md-3">
                {!! Form::label('cnpj_empresa','CNPJ Empresa *') !!}
                {!! Form::input('text', 'cnpj_empresa', null, ['class'=>'form-control','required',  'placeholder'=>'CNPJ Empresa']) !!}
            </div>
            <div class="col-md-5">
                {!! Form::label('empresa','Nome da Empresa *') !!}
                {!! Form::input('text', 'empresa', null, ['class'=>'form-control','required',  'placeholder'=>'Nome da Empresa', 'disabled']) !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('cargo','Cargo *') !!}
                {!! Form::input('text', 'cargo', null, ['class'=>'form-control' ,'required', 'placeholder'=>'Cargo']) !!}
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                {!! Form::submit('Salvar', ['class'=>'btn btn-primary float-right', 'name'=>'submitFunc', 'disabled', 'title'=>'Preencha adequadamente o campo CNPJ']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('script')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script src="{{ asset('js/libraries/jquery.js') }}"></script>
    {{--<script src="{{ asset('js/libraries/jquery.inputmask.bundle.js') }}" defer></script>--}}
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js" defer></script>
    <script>
        $(document).ready(function(){
            $("#cpf").inputmask("999.999.999-99");
            $("#agencia").inputmask("9{1,6}-9");
            $("#numero").inputmask("9{1,10}");
            $("#variacao").inputmask("9{1,3}");
            $("#telefones").inputmask("((99)9{4,5}-9999,){1,4}")
        });
    </script>
    <script>
        $(document).ready(function () {
            $("input[name='cnpj_empresa']").blur(function () {
                var nome_empresa = $("input[name='empresa']");
                var btn_salvar = $("input[name='submitFunc']");
                $.getJSON(
                    '{{ url('/empresa/retornarEmpresa') }}',
                    {cnpj: $(this).val()},
                    function (json) {
                        nome_empresa.val(json.nome_empresa);
                        if(json.valido == true){
                            btn_salvar.removeAttr('disabled');
                            btn_salvar.removeAttr('title');
                        }else{
                            btn_salvar.attr('disabled','disabled');
                            btn_salvar.attr('title','Preencha adequadamente o campo CNPJ');
                        }
                    })
            })
        });
    </script>
@endsection
