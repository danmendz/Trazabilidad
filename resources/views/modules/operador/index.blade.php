@extends('layouts.dashboard')

@section('template_title')
    Operadores
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Operadores') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('operadores.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <!-- Formulario de búsqueda -->
                    <form method="GET" action="{{ route('operadores.index') }}" class="mb-4">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $nombre }}">
                            </div>
                            <div class="col">
                                <input type="text" name="id_area" class="form-control" placeholder="ID Area" value="{{ $id_area }}">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                    </form>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>ID Area</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($operadores as $operadore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $operadore->nombre }}</td>
                                            <td>{{ $operadore->id_area }}</td>
                                            <td>
                                                <form action="{{ route('operadores.destroy', $operadore->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('operadores.show', $operadore->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('operadores.edit', $operadore->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $operadores->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection