<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="codigo_proyecto" class="form-label">{{ __('Código Proyecto') }}</label>
            <input type="text" name="codigo_proyecto" class="form-control @error('codigo_proyecto') is-invalid @enderror" value="{{ old('codigo_proyecto', $reportesMaquinado?->codigo_proyecto) }}" id="codigo_proyecto" placeholder="Codigo Proyecto">
            {!! $errors->first('codigo_proyecto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="codigo_partida" class="form-label">{{ __('Código Partida') }}</label>
            <input type="text" name="codigo_partida" class="form-control @error('codigo_partida') is-invalid @enderror" value="{{ old('codigo_partida', $reportesMaquinado?->codigo_partida) }}" id="codigo_partida" placeholder="Codigo Partida">
            {!! $errors->first('codigo_partida', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="text" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $reportesMaquinado?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora" class="form-label">{{ __('Hora') }}</label>
            <input type="text" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora', $reportesMaquinado?->hora) }}" id="hora" placeholder="Hora">
            {!! $errors->first('hora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="turno" class="form-label">{{ __('Turno') }}</label>
            <input type="text" name="turno" class="form-control @error('turno') is-invalid @enderror" value="{{ old('turno', $reportesMaquinado?->turno) }}" id="turno" placeholder="Turno">
            {!! $errors->first('turno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="accion" class="form-label">{{ __('Acción') }}</label>
            <input type="text" name="accion" class="form-control @error('accion') is-invalid @enderror" value="{{ old('accion', $reportesMaquinado?->accion) }}" id="accion" placeholder="Accion">
            {!! $errors->first('accion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estatus" class="form-label">{{ __('Estatus') }}</label>
            <input type="text" name="estatus" class="form-control @error('estatus') is-invalid @enderror" value="{{ old('estatus', $reportesMaquinado?->estatus) }}" id="estatus" placeholder="Estatus">
            {!! $errors->first('estatus', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tiempo_total" class="form-label">{{ __('Tiempo Total') }}</label>
            <input type="text" name="tiempo_total" class="form-control @error('tiempo_total') is-invalid @enderror" value="{{ old('tiempo_total', $reportesMaquinado?->tiempo_total) }}" id="tiempo_total" placeholder="Tiempo Total">
            {!! $errors->first('tiempo_total', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_area" class="form-label">{{ __('ID Área') }}</label>
            <input type="text" name="id_area" class="form-control @error('id_area') is-invalid @enderror" value="{{ old('id_area', $reportesMaquinado?->id_area) }}" id="id_area" placeholder="Id Area">
            {!! $errors->first('id_area', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_maquina" class="form-label">{{ __('ID Máquina') }}</label>
            <input type="text" name="id_maquina" class="form-control @error('id_maquina') is-invalid @enderror" value="{{ old('id_maquina', $reportesMaquinado?->id_maquina) }}" id="id_maquina" placeholder="Id Maquina">
            {!! $errors->first('id_maquina', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_operador" class="form-label">{{ __('ID Operador') }}</label>
            <input type="text" name="id_operador" class="form-control @error('id_operador') is-invalid @enderror" value="{{ old('id_operador', $reportesMaquinado?->id_operador) }}" id="id_operador" placeholder="Id Operador">
            {!! $errors->first('id_operador', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>