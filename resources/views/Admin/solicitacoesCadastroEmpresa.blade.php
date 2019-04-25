@extends('layouts.AdminApp')
@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        <h3>Solicitações de Cadastro - Empresa</h3>
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
                    <th>CNPJ</th>
                    <th>Data Cadastramento</th>
                    <th>Ações</th>
                    </thead>
                    <tbody>
                    @foreach($solicitacoes as $solicitacao)
                        <tr>
                            <td class="text-center">
                                <a class="btn text-dark"
                                   href="{{ url('admin/solicitacoesEmpresa/'.$solicitacao->id) }}">
                                    {{ $solicitacao->nome}}
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="btn text-dark"
                                   href="{{ url('admin/solicitacoesEmpresa/'.$solicitacao->id) }}">
                                    {{ $solicitacao->cnpj }}
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <a class="btn text-dark"
                                   href="{{ url('admin/solicitacoesEmpresa/'.$solicitacao->id) }}">
                                    {{ $solicitacao->created_at }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('admin/empresa/'.$solicitacao->id.'/aprovar') }}"
                                   class="btn btn-success">Aprovar</a>
                                <a href="{{ url('admin/empresa/'.$solicitacao->id.'/reprovar') }}"
                                   class="btn btn-danger">Reprovar</a>
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
                <a href="{{ url('/admin/home') }}" class="btn btn-danger">Voltar</a>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/libraries/jquery.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script>
        $(document).ready(function () {
            $('#tableSolCad').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
                "order": [[0, "asc"]]
            });
        });
    </script>
@endsection