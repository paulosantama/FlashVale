@extends('layouts.app')
@section('style')
    <style>
        .itemPrincipal{
            color: white;
            height: 100%;
            width: 100%;
            background-color: mediumseagreen;
            border-radius: 10px;
        }
        /*.itemPrincipal a:link{*/
        .ocultLink:link{
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
        @if((Auth::user()->empresa_id==null)&&(Auth::user()->funcionario_id==null))
            <script>
                window.location.href = '{{ url('/verifica/tipo') }}';
            </script>
        @endif
        <?php
            $empresa = \App\Empresa::find(Auth::user()->empresa_id);
        ?>
        @if((Request::is('*empresa*'))||((Auth::user()->empresa_id!=null)&&(Auth::user()->funcionario_id==null)))
            <?php
            if($empresa->ativo!=1){
                echo "Aguarde a aprovação do cadastro";
            }
            ?>
        @endif
        @if($empresa->ativo==1)
            <div class="row">
                <div class="col-md-2 col-6 mt-2" style="height: 150px;">
                    <a href="{{ url('/empresa/funcionarios/solicitacoes') }}" class="ocultLink">
                        <div class="itemPrincipal text-center">
                            <table height="100%" width="100%">
                                <tr>
                                    <td class="align-middle">
                                        <h5>
                                            Solicitações de Cadastro
                                        </h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-6 mt-2" style="height: 150px;">
                    <a href="{{ url('/vale/solicitacoes') }}" class="ocultLink">
                        <div class="itemPrincipal text-center">
                            <table height="100%" width="100%">
                                <tr>
                                    <td class="align-middle">
                                        <h5>
                                            Solicitações de Vale
                                        </h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-6 mt-2" style="height: 150px;">
                    <a href="{{ url('/folha') }}" class="ocultLink">
                        <div class="itemPrincipal text-center">
                            <table height="100%" width="100%">
                                <tr>
                                    <td class="align-middle">
                                        <h5>
                                            Folha Salarial
                                        </h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 col-6 mt-2" style="height: 150px;">
                    <a href="{{ url('/empresa/funcionarios/') }}" class="ocultLink">
                        <div class="itemPrincipal text-center">
                            <table height="100%" width="100%">
                                <tr>
                                    <td class="align-middle">
                                        <h5>
                                            Funcionários
                                        </h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
