@extends('layouts.dashboard')

@section('template_title')
    {{ __('Update') }} Maquina
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Maquina</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('maquinas.update', $maquina->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('modules.maquina.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
