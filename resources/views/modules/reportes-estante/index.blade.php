@extends('layouts.dashboard')

@section('template_title')
    Reportes Estantes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Reportes Estantes') }}
                            </span>

                            @can('acceder-admin-ventas')
                                <div class="float-right">
                                    <a href="{{ route('reportes-estantes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    {{ __('Crear nuevo reportes estantes') }}
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <!-- Acordeón de filtros -->
                    <div id="accordionFilters" class="mb-4">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="text-decoration: none; font-weight: bold; padding: 0; font-size: 1rem;">
                                        <i class="fas fa-search"></i>
                                        Filtros de búsqueda
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionFilters">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('reportes-estantes.index') }}">
                                        <div class="form-row mb-2">
                                            <div class="col-md-4">
                                                <input type="text" name="codigo_proyecto" class="form-control" placeholder="Código Proyecto" value="{{ $codigo_proyecto }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="codigo_partida" class="form-control" placeholder="Código Partida" value="{{ $codigo_partida }}">
                                            </div>
                                            <div class="col-md-4">
                                                <select name="accion" class="form-control">
                                                    <option value="">Seleccione Acción</option>
                                                    <option value="entrada" {{ $accion == 'entrada' ? 'selected' : '' }}>Entrada</option>
                                                    <option value="salida" {{ $accion == 'salida' ? 'selected' : '' }}>Salida</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-md-4">
                                                <input type="date" name="fecha_desde" class="form-control" value="{{ $fecha_desde }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="fecha_hasta" class="form-control" value="{{ $fecha_hasta }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="nombre_estante" class="form-control" placeholder="Estante" value="{{ $nombre_estante }}">
                                            </div>
                                        </div>
                                        <div class="form-row mb-2">
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                    Buscar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Código Proyecto</th>
									<th >Código Partida</th>
									<th >Fecha</th>
									<th >Hora</th>
									<th >Acción</th>
									<th >Minutos</th>
									<th >Estatus</th>
									<th >Estante</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reportesEstantes as $reportesEstante)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $reportesEstante->codigo_proyecto }}</td>
										<td >{{ $reportesEstante->codigo_partida }}</td>
										<td >{{ $reportesEstante->fecha }}</td>
										<td >{{ $reportesEstante->hora }}</td>
										<td >{{ $reportesEstante->accion }}</td>
										<td >{{ $reportesEstante->tiempo_total }}</td>
										<td >{{ $reportesEstante->estatus }}</td>
										 <!-- Mostrar el nombre del estante en lugar del ID -->
                                         <td>{{ $reportesEstante->estante->nombre }}</td>
                                            <td>
                                                @can('acceder-admin-ventas')
                                                <form action="{{ route('reportes-estantes.destroy', $reportesEstante->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('reportes-estantes.show', $reportesEstante->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('reportes-estantes.edit', $reportesEstante->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('¿Estás seguro de eliminar el reporte de estante?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                                @else 
                                                <a class="btn btn-sm btn-primary " href="{{ route('reportes-estantes.show', $reportesEstante->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $reportesEstantes->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
