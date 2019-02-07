@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Selecione o tipo de Usuário</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <a href="{{ url('/empresa/cadastro') }}" class="btn btn-primary">Empresa</a>
                                <a href="{{ url('/funcionario/cadastro') }}" class="btn btn-secondary">Funcionário</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
