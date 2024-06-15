@extends('layouts.dashboard')

@section('template_title')
    {{ $operadore->name ?? __('Show') . " " . __('Operadore') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Operadore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('operadores.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $operadore->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Area:</strong>
                                    {{ $operadore->id_area }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
