@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        <h3>Solicitações de Vale</h3>
        <br/>
        @if(Session::has('mensagem'))
            <div class="alert alert-warning">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        <div id="temp-id"></div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive-md table-hover" id="tableSolicitacoes">
                    <thead class="navVerde">
                        @if($tipoUser==0)
                            <th>Empresa</th>
                        @else
                            <th>Funcionário</th>
                        @endif
                        <th>Data da Solicitação</th>
                        <th>Valor(R$)</th>
                        <th>Status</th>
                        @if(!$tipoUser==0 )
                            <th>Ações</th>
                        @endif
                    </thead>
                    <tbody>

                        @foreach($solicitacoes as $sol)
                            <?php
                                if($tipoUser==0){
                                    $sujeito = $sol->empresa->nome;
                                }else{
                                    $sujeito = $sol->funcionario->nome;
                                }
                                $data = $sol->created_at;
                                $valor = $sol->valor_solicitado;
                                $status = $sol->statusVale->descricao;
                            ?>
                            <tr>
                                <td>{{ $sujeito }}</td>
                                <td>{{ $data }}</td>
                                <td>{{ $valor }}</td>
                                @if($sol->status_vale_id==1)
                                    <td>
                                        <span class="badge badge-warning">
                                            {{ $status }}
                                        </span>
                                    </td>
                                @elseif($sol->status_vale_id==2)
                                    <td>
                                        <span class="badge badge-success">
                                            {{ $status }}
                                        </span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge badge-danger">
                                            {{ $status }}
                                        </span>
                                    </td>
                                @endif
                                @if((!$tipoUser==0))
                                    @if($sol->status_vale_id==1)
                                        <td style="display: flex;">
                                            <a href="{{ url('vale/'.$sol->id.'/reprovar') }}" class="btn btn-danger btn-sm"><span class="fa fa-times"></span> Reprovar</a>
                                            <a href="{{ url('vale/'.$sol->id.'/aprovar') }}" class="btn btn-success btn-sm"><span class="fa fa-check"></span> Aprovar</a>
    {{--                                        <button onclick="setId('{{ $sol->id }}')">V</button>--}}
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
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
                @if($tipoUser==0)
                    <a href="{{ url('/funcionario/home') }}" class="btn btn-danger">Voltar</a>
                @else
                    <a href="{{ url('/empresa/home') }}" class="btn btn-danger">Voltar</a>
                @endif
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
            $('#tableSolicitacoes').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                }
            });
        } );
    </script>
    <script>
        function confirmacaoAprovacao() {
            var idSol = document.getElementById('temp-id').innerHTML;
            var certeza = confirm('Realmente deseja aprovar a solicitação de vale?');
            if (certeza){
                alert(destino);
            }
        }
        function setId(id) {
            var div = document.getElementById('temp-id');
            div.innerHTML = id;
            // confirmacaoAprovacao();
        }
    </script>
@endsection
