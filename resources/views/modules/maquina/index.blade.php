@extends('layouts.dashboard')

@section('template_title')
    Máquinas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Máquinas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('maquinas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nueva máquina') }}
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
                                        <th>Nombre</th>
                                        <th>Estatus</th>
                                        <th>Área</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maquinas as $maquina)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $maquina->nombre }}</td>
										<td >{{ $maquina->estatus }}</td>
										<td>{{ $maquina->area ? $maquina->area->nombre : 'Área no asignada' }}</td>

                                            <td>
                                                <form action="{{ route('maquinas.destroy', $maquina->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('maquinas.show', $maquina->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('maquinas.edit', $maquina->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('¿Estás seguro de que quieres eliminar la máquina?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $maquinas->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
