<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"--}}
          {{--integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
    <style>
        .backGreen {
            background-color: green;
        }

        .titulo {
            font-family: Georgia;
            font-weight: bold;
        }

        body {
            font-size: 14pt;
        }

        .boxTitulo {
            border-style: solid;
            border-radius: 15px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="container-fluid boxTitulo">
        <br/>
        {{--<div class="row" >--}}
        {{--<div class="col-md-4"></div>--}}
        {{--<div class="col-md-4 backGreen">--}}
        {{--<img src="{{ asset('img/logo3_cropped.png') }}" class="img-fluid" width="100%">--}}
        {{--</div>--}}
        {{--<div class="col-md-4"></div>--}}
        {{--</div>--}}
        <h3 class="titulo">Vales por Funcionário</h3>
        <hr style="border-color: black;">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        Nome:
                    </div>
                    <div class="col-md-9">
                        {{ $func->nome }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        CPF:
                    </div>
                    <div class="col-md-9">
                        {{ $func->cpf }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Cargo:
                    </div>
                    <div class="col-md-9">
                        {{ $func->cargo }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        Empresa:
                    </div>
                    <div class="col-md-9">
                        {{ $empresa->nome }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        CNPJ:
                    </div>
                    <div class="col-md-9">
                        {{ $empresa->cnpj }}
                    </div>
                </div>
            </div>
            {{--{{ $empresa->nome }}--}}
            {{--<br/>--}}
        </div>
        <br/>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-responsive-md">
                    <thead class="thead-dark">
                        <th>Data de solicitação</th>
                        <th>Data de resposta</th>
                        <th>Valor Solicitado</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                    @foreach($solicitacoes as $sol)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($sol->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($sol->updated_at)->format('d/m/Y H:i:s') }}</td>
                            <td>R$ {{ $sol->valor_solicitado }}</td>
                            <td>{{ $sol->statusVale->descricao }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"--}}
        {{--integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"--}}
        {{--crossorigin="anonymous"></script>--}}
</body>
</html>