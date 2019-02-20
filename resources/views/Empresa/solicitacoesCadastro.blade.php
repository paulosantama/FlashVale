@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        <h3>Solicitações de Cadastro</h3>
        <br/>
        @if(Session::has('mensagem'))
            <div class="alert alert-warning">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive-md table-hover" id="tableSolCad">
                    <thead class="navVerde">
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Ações</th>
                    </thead>
                    <tbody>
                    @foreach($solicitacoes as $solicitacao)
                        <?php
                        $funcionario = $solicitacao->funcionario;
                        ?>
                        <tr>
                            <td class="text-center">
                                <a class="btn text-dark" href="{{ url('/empresa/funcionarios/'.$solicitacao->id) }}">
                                    {{ $funcionario->nome}}
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="btn text-dark" href="{{ url('/empresa/funcionarios/'.$solicitacao->id) }}">
                                    {{ $funcionario->cargo }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('/empresa/funcionarios/'.$solicitacao->id.'/aprovar') }}" class="btn btn-success">Aprovar</a>
                                <a href="{{ url('/empresa/funcionarios/'.$solicitacao->id.'/reprovar') }}" class="btn btn-danger">Reprovar</a>
                            </td>
                        </tr>
                        </a>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ url('/empresa/home') }}" class="btn btn-danger">Voltar</a>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/libraries/jquery.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script>
        $(document).ready( function () {
            $('#tableSolCad').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });
        } );
    </script>
@endsection