@extends('layouts.dashboard')

@section('template_title')
    {{ $maquina->name ?? __('Show') . " " . __('Maquina') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Maquina</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('maquinas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $maquina->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estatus:</strong>
                                    {{ $maquina->estatus }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Area:</strong>
                                    {{ $maquina->id_area }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
