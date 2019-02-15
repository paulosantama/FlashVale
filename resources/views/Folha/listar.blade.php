@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('mensagem'))
            <div class="alert alert-warning">{{Session::get('mensagem')}}</div>
        @endif
        @if(Session::has('mensagemSucesso'))
            <div class="alert alert-success">{{Session::get('mensagemSucesso')}}</div>
        @endif
        {{--<div class="row">--}}
            {{--<div class="col-md-8"></div>--}}
            {{--<div class="col-md-2">--}}
                {{--<label for="referencia">Referência</label>--}}
                {{--<input type="text" name="referencia" class="form-control">--}}
            {{--</div>--}}
            {{--<div class="col-md-2">--}}
                {{--<table width="100%" height="100%">--}}
                    {{--<tr>--}}
                        {{--<td class="align-bottom">--}}
                            {{--<button class="btn btn-primary align-bottom">Buscar</button>--}}
                            {{--<button class="btn btn-primary align-bottom">--}}
                                {{--<span class="fa fa-refresh"></span>--}}
                            {{--</button>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
        <br/>
        <div class="row">
            <div class="col-md-12" style="text-align: right">
                <a href="{{url('folha/renovar')}}" class="btn btn-primary" title="Reinicia folha para o mês vigente.">
                    Renovar Folha
                </a>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-responsive-md">
                    <thead class="navVerde">
                    <th>Funcionário</th>
                    <th>Salário Original(R$)</th>
                    <th>Salário Atual(R$)</th>
                    <th>Referência</th>
                    <th>Ações</th>
                    </thead>
                    <tbody>
                    @foreach($funcionarios as $func)
                        <?php
                            $folha = $func->folhaSalarialFuncionario->first();
                        ?>
                        <tr>
                            <td>{{ $func->nome }}</td>
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
                                    <a href="{{ url('folha/'.$func->id.'/editar') }}" class="">
                                        <span class="btn btn-warning fa fa-pencil"></span>
                                    </a>
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
                <a href="{{ url('/empresa/home') }}" class="btn btn-danger">Voltar</a>
            </div>
        </div>
    </div>
@endsection
