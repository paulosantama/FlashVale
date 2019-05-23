<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .titulo {
            font-family: Georgia;
            font-weight: bold;
        }
        body {
            font-size: 10pt;
        }
        .boxTitulo {
            /*border-style: solid;*/
            /*border-radius: 15px;*/
        }
        #tabResumo td {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div id="dadosPhp" style="display: none;">{{ json_encode($StatFuncvales, JSON_UNESCAPED_UNICODE) }}</div>
    <div id="dadosEstatisticos" style="display: none;">{{ json_encode($estatisticas, JSON_UNESCAPED_UNICODE) }}</div>
    <div></div>
    <p>Data do relatório: {{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d/m/Y H:i:s') }}</p>
    <div class="boxTitulo" style="padding-left: 10px; padding-right: 10px;">
        <br/>
        <h3 class="titulo">Vales Visão Geral</h3>
        <hr style="border-color: black;">
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
            <h4>Período ({{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} até {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }})</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <br/>
            <div id="container1"></div>
        </div>
        <div class="col-md-6">
            <br/>
            <div id="container2"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"></div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://code.highcharts.com/highcharts.src.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
<script src="{{ asset('js/Relatorio/ValesVisaoGeral.js') }}"></script>
<script src="{{ asset('js/Relatorio/ValesVisaoGeralFuncionarios.js') }}"></script>
</body>
</html>