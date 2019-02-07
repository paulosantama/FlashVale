@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            Principal
            {{--<div class="card">--}}
                {{--<div class="card-header">Dashboard</div>--}}

                {{--<div class="card-body">--}}
                    {{--@if(Session::has('mensagem'))--}}
                        {{--<div class="alert alert-danger">{{Session::get('mensagem')}}</div>--}}
                    {{--@endif--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success" role="alert">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}
                    {{--@if((Request::is('*empresa*'))||((Auth::user()->empresa_id!=null)&&(Auth::user()->funcionario_id==null)))--}}
                        {{--<?php--}}
                            {{--$empresa = \App\Empresa::find(Auth::user()->empresa_id);--}}
                        {{--?>--}}
                        {{--@if($empresa->ativo!=1)--}}
                            {{--Aguarde a aprovação do cadastro--}}
                        {{--@else--}}
                            {{--<script>--}}
                                {{--window.location.href = '{{ url('/empresa/home') }}';--}}
                            {{--</script>--}}
                        {{--@endif--}}
                    {{--@elseif((Request::is('*funcionario*'))||((Auth::user()->empresa_id==null)&&(Auth::user()->funcionario_id!=null)))--}}
                        {{--<?php--}}
                            {{--$funcionario = \App\Funcionario::find(Auth::user()->funcionario_id);--}}
                            {{--if($funcionario->ativo!=1){--}}
                                {{--echo "Aguarde a aprovação do cadastro por parte da ";--}}
                                {{--echo $funcionario->empresa->nome;--}}
                            {{--}else{--}}

                            {{--}--}}
                        {{--?>--}}
                    {{--@endif--}}
                    {{--@if((Auth::user()->empresa_id==null)&&(Auth::user()->funcionario_id==null))--}}
                            {{--<script>--}}
                                {{--window.location.href = '{{ url('/verifica/tipo') }}';--}}
                            {{--</script>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
@endsection
