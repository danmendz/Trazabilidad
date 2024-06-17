@extends('layouts.dashboard')

@section('template_title')
    {{ $operadore->name ?? __('Mostrar') . " " . __('Operadore') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Operadore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('operadores.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $operadore->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>ID Área:</strong>
                                    {{ $operadore->id_area }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
