@extends('layouts.dashboard')

@section('template_title')
    {{ __('Crear') }} Reportes Maquinado
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Reportes Maquinado</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('reportes-maquinados.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('modules.reportes-maquinado.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
