@extends('layouts.dashboard')

@section('template_title')
    Estantes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Estantes') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('estantes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                    <form method="GET" action="{{ route('estantes.index') }}" class="mb-4">
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
                                        
									<th >Nombre</th>
									<th >Id Area</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estantes as $estante)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $estante->nombre }}</td>
										<td >{{ $estante->id_area }}</td>

                                            <td>
                                                @can('acceder-admin-ventas')
                                                    <form action="{{ route('estantes.destroy', $estante->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary" href="{{ route('estantes.show', $estante->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        
                                                        <!-- Botón Edit -->
                                                        <a class="btn btn-sm btn-success" href="{{ route('estantes.edit', $estante->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                        
                                                        <!-- Botón Delete -->
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                    </form>
                                                @else
                                                    <!-- Si no tiene permiso, solo mostrar el botón de Show -->
                                                    <a class="btn btn-sm btn-primary" href="{{ route('estantes.show', $estante->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                @endcan
                                            </td>                                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $estantes->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
