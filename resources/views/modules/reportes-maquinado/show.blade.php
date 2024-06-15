@extends('layouts.dashboard')

@section('template_title')
    {{ $reportesMaquinado->name ?? __('Show') . " " . __('Reportes Maquinado') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Reportes Maquinado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('reportes-maquinados.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Codigo Proyecto:</strong>
                                    {{ $reportesMaquinado->codigo_proyecto }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Codigo Partida:</strong>
                                    {{ $reportesMaquinado->codigo_partida }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha:</strong>
                                    {{ $reportesMaquinado->fecha }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Hora:</strong>
                                    {{ $reportesMaquinado->hora }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Turno:</strong>
                                    {{ $reportesMaquinado->turno }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Accion:</strong>
                                    {{ $reportesMaquinado->accion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estatus:</strong>
                                    {{ $reportesMaquinado->estatus }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tiempo Total:</strong>
                                    {{ $reportesMaquinado->tiempo_total }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Area:</strong>
                                    {{ $reportesMaquinado->id_area }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Maquina:</strong>
                                    {{ $reportesMaquinado->id_maquina }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Operador:</strong>
                                    {{ $reportesMaquinado->id_operador }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
