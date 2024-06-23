@extends('layouts.dashboard')

@section('template_title')
    Reportes Maquinados
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Reportes Maquinados') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('reportes-maquinados.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo reporte maquinado') }}
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
                                        <th>Código Proyecto</th>
                                        <th>Código Partida</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Turno</th>
                                        <th>Acción</th>
                                        <th>Estatus</th>
                                        <th>Tiempo Total</th>
                                        <th>Área</th>
                                        <th>Máquina</th>
                                        <th>Operador</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reportesMaquinados as $reportesMaquinado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $reportesMaquinado->codigo_proyecto }}</td>
										<td >{{ $reportesMaquinado->codigo_partida }}</td>
										<td >{{ $reportesMaquinado->fecha }}</td>
										<td >{{ $reportesMaquinado->hora }}</td>
										<td >{{ $reportesMaquinado->turno }}</td>
										<td >{{ $reportesMaquinado->accion }}</td>
										<td >{{ $reportesMaquinado->estatus }}</td>
										<td >{{ $reportesMaquinado->tiempo_total }}</td>
										<td >{{ $reportesMaquinado->area->nombre ?? 'N/A' }}</td>
										<td >{{ $reportesMaquinado->maquina->nombre ?? 'N/A' }}</td>
										<td >{{ $reportesMaquinado->operador->nombre ?? 'N/A' }}</td>

                                            <td>
                                                <form action="{{ route('reportes-maquinados.destroy', $reportesMaquinado->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('reportes-maquinados.show', $reportesMaquinado->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('reportes-maquinados.edit', $reportesMaquinado->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('¿Estás seguro de eliminar el reporte maquinado?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $reportesMaquinados->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
