<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="codigo_proyecto" class="form-label">{{ __('Código Proyecto') }}</label>
            <input type="text" name="codigo_proyecto" class="form-control @error('codigo_proyecto') is-invalid @enderror" value="{{ old('codigo_proyecto', $reportesEstante?->codigo_proyecto) }}" id="codigo_proyecto" placeholder="Codigo Proyecto">
            {!! $errors->first('codigo_proyecto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="codigo_partida" class="form-label">{{ __('Código Partida') }}</label>
            <input type="text" name="codigo_partida" class="form-control @error('codigo_partida') is-invalid @enderror" value="{{ old('codigo_partida', $reportesEstante?->codigo_partida) }}" id="codigo_partida" placeholder="Codigo Partida">
            {!! $errors->first('codigo_partida', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="text" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $reportesEstante?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora" class="form-label">{{ __('Hora') }}</label>
            <input type="text" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora', $reportesEstante?->hora) }}" id="hora" placeholder="Hora">
            {!! $errors->first('hora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="accion" class="form-label">{{ __('Acción') }}</label>
            <input type="text" name="accion" class="form-control @error('accion') is-invalid @enderror" value="{{ old('accion', $reportesEstante?->accion) }}" id="accion" placeholder="Accion">
            {!! $errors->first('accion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tiempo_total" class="form-label">{{ __('Tiempo Total') }}</label>
            <input type="text" name="tiempo_total" class="form-control @error('tiempo_total') is-invalid @enderror" value="{{ old('tiempo_total', $reportesEstante?->tiempo_total) }}" id="tiempo_total" placeholder="Tiempo Total">
            {!! $errors->first('tiempo_total', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estatus" class="form-label">{{ __('Estatus') }}</label>
            <input type="text" name="estatus" class="form-control @error('estatus') is-invalid @enderror" value="{{ old('estatus', $reportesEstante?->estatus) }}" id="estatus" placeholder="Estatus">
            {!! $errors->first('estatus', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_estante" class="form-label">{{ __('ID Estante') }}</label>
            <input type="text" name="id_estante" class="form-control @error('id_estante') is-invalid @enderror" value="{{ old('id_estante', $reportesEstante?->id_estante) }}" id="id_estante" placeholder="Id Estante">
            {!! $errors->first('id_estante', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>