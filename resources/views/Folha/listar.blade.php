@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container" xmlns="">
        <h3>Folhas Salariais</h3>
        <br/>
        @if(Session::has('mensagem'))
            <div class="alert alert-warning">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive-md table-hover" id="tableFolhas">
                    <thead class="navVerde">
                        <th>Funcionário</th>
                        <th>Salário Original(R$)</th>
                        <th>Salário Atual(R$)</th>
                        <th>Referência</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                    <?php
                        $mesAtual = now()->startOfMonth();
                    ?>
                    @foreach($folhas as $folha)
                        <tr>
                            <td>{{ $folha->funcionario->nome }}</td>
                            @if($folha==null)
                                <td>
                                    <a href="{{ url('folha/'.$func->id.'/cadastrar') }}" class="btn btn-primary">Adicionar</a>
                                </td>
                                <td>-</td>
                                <td></td>
                                <td></td>
                            @else
                                <td>{{ $folha->salario_bruto_original }}</td>
                                <td>{{ $folha->salario_bruto_novo }}</td>
                                <?php
                                    $unix = strtotime($folha->created_at);
                                    $data = new DateTime("@$unix");
                                ?>
                                <td>{{ $data->format('Y-m') }}</td>
                                <td>
                                    @if($folha->created_at->gt($mesAtual))
                                    <a href="{{ url('folha/'.$folha->funcionario->id.'/editar') }}" class="">
                                        <span class="btn btn-warning fa fa-pencil"></span>
                                    </a>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{url('folha/renovar')}}" class="btn btn-primary" title="Reinicia folha para o mês vigente.">
                    Renovar Folha
                </a>
                <a href="{{ url('/empresa/home') }}" class="btn btn-danger">
                    Voltar
                </a>
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
            $('#tableFolhas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
                },
                "order": [[ 3, "desc" ], [0, "asc"]]
            });
        } );
    </script>
@endsection
