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

                             <div class="float-right">
                                <a href="{{ route('reportes-estantes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo reportes estantes') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

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
									<th >Tiempo Total en Minutos</th>
									<th >Estatus</th>
									<th >ID Estante</th>

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
										<td >{{ $reportesEstante->id_estante }}</td>

                                            <td>
                                                <form action="{{ route('reportes-estantes.destroy', $reportesEstante->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('reportes-estantes.show', $reportesEstante->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('reportes-estantes.edit', $reportesEstante->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('¿Estás seguro de eliminar el reporte de estante?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
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
