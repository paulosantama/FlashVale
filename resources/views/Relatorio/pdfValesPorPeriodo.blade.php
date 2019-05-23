<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        .backGreen {
            background-color: green;
        }

        .titulo {
            font-family: Georgia;
            font-weight: bold;
        }

        body {
            font-size: 10pt;
        }

        .boxTitulo {
            border-style: solid;
            border-radius: 15px;
        }

        .bordaDireita {
            border-right-style: solid;
            border-width: 0.5px;
            border-color: grey;
        }

        .cabecaTable {
            background-color: black;
            color: white;
        }

        .footTable {
            background-color: #9561e2;
            color: white;
        }

        #tabResumo td {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <p>Data do relatório: {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d/m/Y H:i:s') }}</p>
    <div class="boxTitulo" style="padding-left: 10px; padding-right: 10px;">
        <br/>
        <h3 class="titulo">Vales por Período</h3>
        <hr style="border-color: black;">
        <table class="table">
            <tr>
                <td>Empresa:</td>
                <td>{{ $empresa->nome }}</td>
            </tr>
            <tr>
                <td>CNPJ:</td>
                <td>{{ $empresa->cnpj }}</td>
            </tr>
            <tr>
                <td>Período:</td>
                <td>{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} até {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>
    <h4>Resumo</h4>
    <table class="table table-bordered" id="tabResumo">
        <tr class="cabecaTable">
            <td>Status</td>
            <td>Quantidade</td>
            <td>Valor (R$)</td>
        </tr>
        <tr>
            <td>Em Análise</td>
            <td>{{ count($solicitacoes->where('status_vale_id',1))  }}</td>
            <td>R$ {{ $solicitacoes->where('status_vale_id',1)->sum('valor_solicitado') }}</td>
        </tr>
        <tr>
            <td>Aprovadas</td>
            <td>{{ count($solicitacoes->where('status_vale_id',2))  }}</td>
            <td>R$ {{ $solicitacoes->where('status_vale_id',2)->sum('valor_solicitado') }}</td>
        </tr>
        <tr>
            <td>Reprovadas</td>
            <td>{{ count($solicitacoes->where('status_vale_id',3))  }}</td>
            <td>R$ {{ $solicitacoes->where('status_vale_id',3)->sum('valor_solicitado') }}</td>
        </tr>
        <tr class="footTable">
            <td>Total</td>
            <td>{{ count($solicitacoes) }}</td>
            <td>R$ {{ $solicitacoes->sum('valor_solicitado') }}</td>
        </tr>
    </table>
    <h4>Solicitações</h4>
    <table class="table table-bordered table-striped">
        <tr>
            <td>Funcionário</td>
            <td>Data de solicitação</td>
            <td>Data de resposta</td>
            <td>Valor Solicitado</td>
            <td>Status</td>
        </tr>
        <tbody>
        @foreach($solicitacoes as $sol)
            <tr>
                <td>{{ $sol->funcionario->nome }}</td>
                <td>{{ \Carbon\Carbon::parse($sol->created_at)->format('d/m/Y H:i:s') }}</td>
                <td>
                    @if($sol->statusVale->id!=1)
                        {{ \Carbon\Carbon::parse($sol->updated_at)->format('d/m/Y H:i:s') }}
                    @else
                        -
                    @endif
                </td>
                <td>R$ {{ $sol->valor_solicitado }}</td>
                <td>{{ $sol->statusVale->descricao }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>