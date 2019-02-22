@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        <h2>Folhas Salariais</h2>
        @if(is_null($folhas))
            <?php
                Session::flash('mensagem','ERRO: Folha Salarial não cadastrada.');
            ?>
            <script>
                window.location.href="{{ url('/funcionario/home') }}";
            </script>
        @else
            <div class="row">
                <div class="col-md-12">
            <table class="table table-responsive-md table-hover" id="tableFolhas">
                <thead class="navVerde">
                <th>Referência</th>
                <th>Salário Original (R$)</th>
                <th>Salário Líquido (R$)</th>
                </thead>
                <tbody>
                @foreach($folhas as $folha)
                    <tr>
                        <?php
                            $unix = strtotime($folha->created_at);
                            $data = new DateTime("@$unix");
                        ?>
                        <td>{{ $data->format('Y/m') }}</td>
                        <td>{{ $folha->salario_bruto_original }}</td>
                        <td>{{ $folha->salario_bruto_novo }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="{{ url('funcionario/home') }}" class="btn btn-danger">Voltar</a>
                </div>
            </div>
        @endif
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
                "order": [[ 0, "desc" ]]
            });
        } );
    </script>
@endsection