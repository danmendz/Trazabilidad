@extends('layouts.dashboard')

@section('template_title')
    {{ $estante->name ?? __('Show') . " " . __('Estante') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Estante</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('estantes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $estante->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Area:</strong>
                                    {{ $estante->id_area }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
