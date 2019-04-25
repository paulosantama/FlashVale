@extends('layouts.AdminApp')
{{--@extends('layouts.App')--}}

@section('style')
    <style>
        .itemPrincipal {
            /*color: white;*/
            height: 100%;
            width: 100%;
            /*background-color: #b3120c;*/
            border-radius: 10px;
        }

        /*.itemPrincipal a:link{*/
        .ocultLink:link {
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if(Session::has('mensagem'))
            <div class="alert alert-danger">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-2 col-6 mt-2" style="height: 150px;">
                <a class="ocultLink" href="{{ url('admin/solicitacoesEmpresa') }}">
                    <div class="itemPrincipal navVerde text-center">
                        <table height="100%" width="100%">
                            <tr>
                                <td class="align-middle">
                                    <h5>
                                        Solicitações de Cadastro - Empresas
                                    </h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection